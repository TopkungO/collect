#include <ESP8266WiFi.h>
#include <ArduinoJson.h>
#include <MicroGear.h>
#include <time.h>
#include <Servo.h>
#include <HX711.h>
#include <NewPing.h>


/*---------Wifi---------------*/
const char* ssid = "Top";             // SSID is set
const char* password = "123456789";     // Password is set 

/*---------netpie--------------*/
#define APPID   "FoodPet"
#define KEY     "QgVSVV3gILMsAhJ"
#define SECRET  "Y7ziTGDU3OfQTdEEPHYsoWnXq"
#define ALIAS   "node_mcu"
#define FEEDID   "FoodPet"
#define FEEDAPI  "1bHSroaOwXktjTD8t4tOdbgrTcfF8SoS"
 char* outTopic ="ControlByHtml";
 char* subscribeTopic ="/fooddata/contorl";


/*ultra sonic*/
#define TRIGGER_PIN D5
#define ECHO_PIN D6
#define MAX_DISTANCE 200

NewPing sonar(TRIGGER_PIN,ECHO_PIN,MAX_DISTANCE);
/*---------load call------------*/
#define DOUT  D2
#define CLK   D1
float calibration_factor =400600; 
HX711 scale(DOUT, CLK);

/*--------Servo-----------*/
Servo myservo; //D8

/*--------Time---------------*/
char ntp_server1[20] = "pool.ntp.org";
char ntp_server2[20] = "time.nist.gov";
char ntp_server3[20] = "time.uni.net.th";
int timezone = 7 * 3600;
int dst = 0;

int hour_ch=0;
int min_ch=0;
float food_vol=0;

WiFiClient client;
int timer = 0;
MicroGear microgear(client);
//เมื่อมีMsgเข้ามา
void onMsghandler(char* topic, uint8_t* msg, unsigned int msglen){
  Serial.print("Incoming message --> ");
  msg[msglen]='\0';
  Serial.println((char *)msg);
  
  if(*(char *)msg=='0'){
    myservo.write(0);
    
    }else if( * (char *)msg=='1'){
      myservo.write(30);
      microgear.chat(outTopic,"Time"+String(food_vol));
      }else{
            String m=(char*)msg;
            m[msglen] = '\0';
            if(m.substring(0,1)=="t"){
              hour_ch=m.substring(1,3).toInt();
              min_ch=m.substring(4,6).toInt();
              chTime(hour_ch,min_ch);
              
              
              }else if(m.substring(0,1)=="f"){
                food_vol=m.substring(1,4).toFloat();
                
                
                }
            }    
}

//เมื่อเชื่อมกับnetpieเเล้ว
void onConnected(char* attribute, uint8_t* msg, unsigned int msglen){
  Serial.println("Connected to NETPIE...");
  /* Set the alias of this microgearALIAS */
  microgear.setAlias(ALIAS);
  microgear.subscribe(subscribeTopic);
}

/*--------setup-----------------*/
void setup() {
  microgear.on(MESSAGE,onMsghandler);
  microgear.on(CONNECTED,onConnected);
 
  Serial.begin(115200); 
  delay(10);
  myservo.attach(D8);
  myservo.write(0);
    /*time*/
  configTime(timezone, dst, ntp_server1, ntp_server2, ntp_server3);
  Serial.println("\nWaiting for time");
  while (!time(nullptr)) {
    Serial.print(".");
    delay(1000);
  }
  /*load call*/
  Serial.print("Calibrating...");
  scale.set_scale(calibration_factor); // ปรับค่า calibration factor
  scale.tare(); //รีเซตน้ำหนักเป็น 

  /*configWiFi*/
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println("WiFi connected");
  Serial.println(WiFi.localIP());

  microgear.init(KEY,SECRET,ALIAS);
  microgear.connect(APPID);
}
/*----------End Setup----------------*/

/*-------------loop------------------*/
void loop() {
  time_t now = time(nullptr);
  struct tm* p_tm = localtime(&now);
  static unsigned long timer1 = millis();
  static unsigned long timer2 = millis();
  static unsigned long timer3 = millis();
  if(microgear.connected()){ 
    microgear.loop();
    if((millis()-timer3)>=500){
      timer3=millis();
      float callch=scale.get_units(2);
      if(callch>=food_vol){
        myservo.write(0);
        callch=0;
      }
     } 
   if((millis()-timer1)>=1000){
    timer1=millis();
      //showtime();
      chTime(hour_ch,min_ch);
      float callch=scale.get_units(5);
      Serial.println(scale.get_units(5),2);
      //เช็คปริมาณอาหาร

      
      DynamicJsonDocument doc(1024);
      doc["hour_ch"]=hour_ch;
      doc["min_ch"]=min_ch;
      doc["food_vol"]=food_vol;
      doc["load"]=callch;
      String jsonData;
      serializeJson(doc, jsonData);  
      microgear.chat(outTopic,jsonData);    
      //ส่งค่าเวลาที่ตั้งการให้อาหาร ไปที่หน้าเว็บ
      //microgear.chat(outTopic,str);
      
      timer = 0;
   }else timer += 100;
   
   //เช็คปริมานอาหารเเล้วส่ง
   if((millis()-timer2)>=5000){
    timer2=millis();
      int l=30-(sonar.ping_cm());
      String sonar_data=String(l);
      //ส่งค่าsonar ไปที่หน้าเว็บ
      microgear.chat(outTopic,"sonar"+sonar_data);
   
    timer = 0;
   }
   else timer += 100;
 
  }else{
    Serial.println("Connection lost , reconnec.");
    if (timer >= 5000) {
      microgear.connect(APPID);
      timer = 0;
    }
    else timer += 100;
  }
}
/*--------End loop-------------*/
void chTime(int hour_ch,int min_ch){
  time_t now = time(nullptr);
  struct tm* p_tm = localtime(&now);
  
  int tm_hour=p_tm->tm_hour;
  int tm_min=p_tm->tm_min;
  int tm_sec=p_tm->tm_sec;
  if(tm_hour==hour_ch && tm_min==min_ch && tm_sec==0){
    myservo.write(30);
    delay(500);
  
    //ส่งค่า"Time"ไปเพื่อสั่งให้บันทึกลงsql
    microgear.chat(outTopic,"Time"+String(food_vol));
    }
  }

void showtime(){
  //นาฬิกา
  time_t now = time(nullptr);
  struct tm* p_tm=localtime(&now);
  String timeNow = ""; 
  timeNow += String(p_tm->tm_hour);
  timeNow += ":";
  timeNow += String(p_tm->tm_min);
  timeNow += ":";
  timeNow += String(p_tm->tm_sec);
  timeNow += " ";
  timeNow += String(p_tm->tm_mday); 
  timeNow += "-";
  timeNow += String(p_tm->tm_mon + 1);
  timeNow += "-";  
  timeNow += String(p_tm->tm_year + 1900);
  Serial.println(timeNow);
  
  }
