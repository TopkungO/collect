class Header extends HTMLElement {
    connectedCallback() {
      this.innerHTML = `
              <header>
                  <nav>
                     <div class="container">
                         <div class="nav-wrapper">
                              <div class="logo">
                                  <img src="img/logo.png" width="50" height="50"></img>
                                  <h3>PROFOLIO</h3>
                              </div>
                              <ul class="menu">
                                  <li><a href="index.php">Home</a></li>
                                  <li>
                                    <a href="about.php">About</a>
                                  </li>
                                  <li><a href="#">Portfolio</a></li>
                                  <li><a href="#">Education</a></li>
                                  <li><a href="#">Contact</a></li>
                              </ul>
                         </div>
                      </div> 
                  </nav>
              </header>`;
    }
  }
  
  class Footer extends HTMLElement {
    connectedCallback() {
      this.innerHTML = `
              <footer>
                  <div class="container">
                      <div class="footer-copyright text-center py-3">by Mr.Krerkpon Siriwutthanpaitoon</div>
                  </div>
              </footer>`;
    }
  }
  customElements.define("main-header", Header);
  customElements.define("main-footer", Footer);
  