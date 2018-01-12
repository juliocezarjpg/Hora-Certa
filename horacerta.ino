#include <Wire.h>  //INCLUSÃO DE BIBLIOTECA
#include <LiquidCrystal_I2C.h> //INCLUSÃO DE BIBLIOTECA
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include<String.h>

const char* ssid = "Hora_certa";
const char* password = "tomeseuremedio";
String remedio;

LiquidCrystal_I2C lcd(0x27, 16, 2); //FUNÇÃO DO TIPO "LiquidCrystal_I2C"

//Constantes
int led = 16;//porta d0
int botaoLig = 15;//porta d8
int botaoDes = 13;//porta d7

//Varável de estado dos botões
int estadobotaoLig = 0;
int estadobotaoDes = 0;

void setup() {

  Serial.begin(115200);
  
  // Define o pino 16 como saida
  pinMode(16, OUTPUT);
  //Define os pinos como entrada
  pinMode(15, INPUT);
  pinMode(13, INPUT);

  Wire.begin(D2, D1);
  lcd.init();   // INICIALIZA O DISPLAY LCD
  lcd.backlight(); // HABILITA O BACKLIGHT (LUZ DE FUNDO) 

  Serial.print("Conectando na rede ");
  Serial.println(ssid);
  connect_wifi();
  Serial.println(WiFi.localIP());
}
 
void loop() {

  //exibição no display
  lcd.setCursor(0, 0);//SETA A POSIÇÃO QUE O CURSOR EXIBE O TEXTO
  lcd.print("HORA CERTA"); // EXIBE O TEXTO NA PRIMEIRA LINHA
  delay(100);
  requisicao();
  requisicao_horario();
  
  //Atribuindo resultado para o estado do botão
  estadobotaoLig = digitalRead(botaoLig);
  estadobotaoDes = digitalRead(botaoDes); 

   if (estadobotaoLig == HIGH)// Botão recebe 1
  {
    lcd.setCursor(0, 1);
    lcd.print ("                "); 
    if (remedio != "nada"){
    digitalWrite(led,LOW);
    requisicao_registro();
    delay(60000);
    
    }
  } 
}

void connect_wifi(){
  //Inicia o WiFi
  WiFi.begin(ssid, password);
  Serial.print("Conectando");
  //Loop até conectar no WiFi
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
}

void requisicao(){ 

  char site[151] = {"http://10.42.0.1/Hora-Certa/php/agora.php?cpf=113.440.254-61"};

   if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
     HTTPClient http;  //Declare an object of class HTTPClient
     http.begin(site);
      int httpCode = http.GET(); 
      if (httpCode > 0) { //Check the returning code
  
        String payload = http.getString();   //Get the request response payload
        Serial.println(payload);                     //Print the response payload
        remedio = payload;
        if (payload != "nada"){
          lcd.setCursor(0, 1);
          lcd.print (payload);
          digitalWrite(led,HIGH);
        }
     }     
      http.end();   //Close connection
   }  
}

void requisicao_horario(){ 

  char site[151] = {"http://10.42.0.1/Hora-Certa/php/hora_agora.php"};

   if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
     HTTPClient http;  //Declare an object of class HTTPClient
     http.begin(site);
      int httpCode = http.GET(); 
      if (httpCode > 0) { //Check the returning code
  
        String payload = http.getString();   //Get the request response payload
        Serial.println(payload);                     //Print the response payload
        lcd.setCursor(11 , 0);//SETA A POSIÇÃO QUE O CURSOR EXIBE O TEXTO
        lcd.print(payload); // EXIBE O TEXTO NA PRIMEIRA LINHA
     }     
      http.end();   //Close connection
   }  
}
void requisicao_registro(){
  String site = "http://10.42.0.1/Hora-Certa/php/registrar_horario.php?cpf=113.440.254-61&&remedio=";
  site.concat(remedio);
  Serial.println(site);

   if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
      HTTPClient http;  //Declare an object of class HTTPClient
      http.begin(site);
      int httpCode = http.GET(); 
      if (httpCode > 0) { //Check the returning code
  
        String payload = http.getString();   //Get the request response payload
        Serial.println(payload);                     //Print the response payload
        lcd.setCursor(11 , 0);//SETA A POSIÇÃO QUE O CURSOR EXIBE O TEXTO
        lcd.print(payload); // EXIBE O TEXTO NA PRIMEIRA LINHA
     }     
      http.end();   //Close connection
   } 
  
  
  }





