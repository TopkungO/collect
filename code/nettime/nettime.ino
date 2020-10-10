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

String STATE ="0";//สถานะเครื่อง
String data_send="0,0,0,0,0"; //"ชัวโมง/นาที่/ปริมาณ/สถานะให้/สถานะเครื่อง"
int hour_netpie=0;
int min_netpie=0;
float food_vol=0;
String status_food="0";

WiFiClient client;
int timer = 0;
MicroGear microgear(client);
//เมื่อมีMsgเข้ามา
void onMsghandler(char* topic, uint8_t* msg, unsigned int msglen){
  Serial.print("Incoming message --> ");
  msg[msglen]='\0';
  Serial.println((char *)msg);
  
  if(*(char *)msg=='?'){

    }else{
      if(*(char*)msg=='o'){
        myservo.write(90);
        status_food="1";
        
        }else if(*(char*)msg=='c'){
          myservo.write(0);
          status_food="0";
          
          }else{
            String m=(char*)msg;
            m[msglen] = '\0';
            if(m.substring(0,3)=="hou"){
              hour_netpie=m.substring(5,m.length()+1).toInt();    
              chTime(hour_netpie,min_netpie,food_vol);
              Serial.println(hour_netpie);
              
            }else if(m.substring(0,3)=="min"){
              min_netpie=m.substring(4,m.length()+1).toInt();
              chTime(hour_netpie,min_netpie,food_vol);
              Serial.println(min_netpie);
              
              }else if(m.substring(0,3)=="foo"){
                food_vol=m.substring(5,m.length()+1).toFloat();
                chTime(hour_netpie,min_netpie,food_vol);
                Serial.println(food_vol);
                } 
            }
  
  }//else ?
}

//เมื่อเชื่อมกับnetpieเเล้ว
void onConnected(char* attribute, uint8_t* msg, unsigned int msglen){
  Serial.println("Connected to NETPIE...");
  /* Set the alias of this microgearALIAS */
  microgear.setAlias(ALIAS);
  STATE = "1"; //สถานะเครื่อง
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
  //float scal=(scale.get_units(), 2);
  static unsigned long timer1 = millis();
  static unsigned long timer2 = millis();
  static unsigned long timer3 = millis();

  if(microgear.connected()){ 
    microgear.loop();
   /*if((millis()-timer1)>=1000){
    timer1=millis();
    chTime(hour_netpie,min_netpie);
    
    timer = 0;
    }else timer += 100;*/
    if((millis()-timer3)>=500){
      timer3=millis();
      //"ชัวโมง/นาที่/ปริมาณ/สถานะให้/สถานะเครื่อง"
    data_send  = hour_netpie;//0
    data_send +=",";
    data_send += min_netpie;//1
    data_send +=",";
    data_send += food_vol;//2
    data_send +=",";
    data_send += status_food;//3
    data_send +=",";
    data_send += STATE;//4
    microgear.publish("/data_send",data_send);
      }
    
   if((millis()-timer1)>=1000){
    timer1=millis();
      showtime();
      chTime(hour_netpie,min_netpie,food_vol);
      Serial.println(scale.get_units(),2);
      String sca=String(scale.get_units(),2);
      /*String Data="{\"scale\":";
      Data +=sca;
      Data +="}";
      Serial.print("Write FEED-->");
      Serial.println(Data);
      microgear.writeFeed(FEEDID,Data,FEEDAPI);*/
      microgear.publish("/loadCall",sca);
      timer = 0;
   }else timer += 100;
   
   //เช็คปริมานอาหารเเล้วส่ง
   if((millis()-timer2)>=5000){
    timer2=millis();
      int l=30-(sonar.ping_cm());
      microgear.publish("/ultrasonic",l);
      if(l<=10){
        Serial.print("Food Low :");
        Serial.println(l); 
     }else{
       Serial.print("Food :");
       Serial.println(l);
        }
   /* String Data = "{\"sonar\":";
    Data += l;
    Data += "}";
    Serial.print("Write FEED-->");
    Serial.println(Data);
    microgear.writeFeed(FEEDID,Data,FEEDAPI);*/

    /*ส่งข้อมูล JSON*/
    DynamicJsonDocument doc(1024);
    doc["sonnar"]=l;
    String jsonData;
    serializeJson(doc, jsonData);
    Serial.print("Write FEED -->");
    Serial.println(jsonData);
    microgear.writeFeed(FEEDID,jsonData);
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
void chTime(int hour_netpie,int min_netpie,float food_vol){
  time_t now = time(nullptr);
  struct tm* p_tm = localtime(&now);
  
  int tm_hour=p_tm->tm_hour;
  int tm_min=p_tm->tm_min;
  int tm_sec=p_tm->tm_sec;
  if(tm_hour==hour_netpie && tm_min==min_netpie && tm_sec==0){
    myservo.write(90);
    status_food="1";
    Serial.print("Servo 90");
    delay(200);
      /* while((scale.get_units(),2) >= food_vol){
        myservo.write(0);
        status_food="0";
        Serial.print("FoodPet=");
        delay(300);
        }*/
    }
  }
void showtime(){
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
