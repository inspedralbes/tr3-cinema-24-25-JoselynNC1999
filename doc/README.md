# 🎥 **Cinépolis Pedralbes **  

📍 *Gestió de cinema intel·ligent i reserves en línia*  

---
# 📖 Documentació Tècnica del Projecte de Cinema

Aquest document conté la informació tècnica necessària per entendre i treballar amb el projecte del cinema. Inclou detalls sobre els objectius, l'arquitectura, l'entorn de desenvolupament, el desplegament i altres aspectes importants.

---

## 📌 Índex
1. [🎯 Objectius](#-objectius)
2. [🏗️ Arquitectura bàsica](#-arquitectura-bàsica)
3. [🛠️ Configuració de l'entorn de desenvolupament](#-configuracio-de-lentorn-de-desenvolupament)
4. [🚀 Desplegament a producció](#-desplegament-a-produccio)
5. [🔌 API: Llistat d'endpoints](#-api-llistat-dendpoints)
6. [📱 Aplicació Android](#-aplicacio-android)
7. [📎 Altres elements importants](#-altres-elements-importants)

---

## 🎯 Objectius
L'objectiu principal del projecte és desenvolupar una aplicació completa per a la gestió d'un cinema, que inclogui:
- **Backend**: API REST per gestionar pel·lícules, sessions, seients i reserves.
- **Frontend**: Interfície d'usuari per a clients i administradors.
- **Aplicació Android**: Aplicació mòbil per a la reserva de seients i consulta de pel·lícules.

---

## 🏗️ Arquitectura bàsica

### 📌 Tecnologies utilitzades
- **Backend**:
  - 🏗 Framework: Laravel 10
  - 🗄 Base de dades: MySQL
  - 🐳 Contenidors: Docker
  - 🔑 Autenticació: Laravel Sanctum
  - 🧪 Proves: PHPUnit
- **Frontend**:
  - ⚛ Framework: React.js
  - 🛠 Gestió d'estat: Redux
  - 🎨 Estilització: Tailwind CSS
- **Aplicació Android**:
  - 📱 Llenguatge: Kotlin
  - 🏛 Arquitectura: MVVM
  - 🔌 Consum d'API: Retrofit

### 🔄 Interrelació entre els diversos components
📡 **Backend** → Proporciona una API REST per al frontend i l'aplicació Android.
🎨 **Frontend** → Consumeix l'API per mostrar informació de pel·lícules, sessions i gestionar reserves.
📱 **Aplicació Android** → Consumeix l'API per permetre als usuaris reservar seients i consultar informació.

---

## 🛠️ Configuració de l'entorn de desenvolupament

### Backend
1. **Clonar el repositori**:
   ```bash
   git clone https://github.com/JoselynNC1999/projecteCinema.git
   cd projecteCinema/tr3-cinema-24-25-JoselynNC1999/backend
   ```
2. **Configurar `.env` i `.env.testing`**
3. **Iniciar Docker**:
   ```bash
   docker-compose up -d
   ```
4. **Instal·lar dependències**:
   ```bash
   docker exec -it laravel composer install
   ```
5. **Executar migracions i llavors**:
   ```bash
   docker exec -it laravel php artisan migrate:fresh --seed
   ```
6. **Executar proves**:
   ```bash
   docker exec -it laravel php artisan test
   ```

### Frontend
1. **Accedir a la carpeta**:
   ```bash
   cd projecteCinema/tr3-cinema-24-25-JoselynNC1999/frontend
   ```
2. **Instal·lar dependències**:
   ```bash
   npm install
   ```
3. **Executar servidor**:
   ```bash
   npm start
   ```

---

## 🚀 Desplegament a producció

### Backend
1. **Construir contenidors Docker per a producció**:
   ```bash
   docker-compose -f docker-compose.prod.yml up -d
   ```
2. **Executar migracions**:
   ```bash
   docker exec -it laravel php artisan migrate --force
   ```

### Frontend
1. **Construir aplicació**:
   ```bash
   npm run build
   ```
2. **Servir fitxers estàtics** amb Nginx o Apache.

---

## 🔌 API: Llistat d'endpoints

### 🔑 Autenticació
- **POST** `/api/register` → Registre d'usuaris.
- **POST** `/api/login` → Inici de sessió.
- **POST** `/api/logout` → Tancar sessió.

### 🎬 Pel·lícules
- **GET** `/api/movies` → Llistar totes les pel·lícules.
- **GET** `/api/movies/{movie_id}/sessions` → Consultar sessions.

### 🎟️ Seients
- **GET** `/api/seats` → Llistar seients disponibles.

### 📅 Reservacions
- **POST** `/api/reservations` → Crear reserva.
- **GET** `/api/reservations` → Llistar reserves.

### 🛠 Administrador
- **GET** `/api/admin/dashboard` → Panell d'administració.

---

## 📱 Aplicació Android
L'aplicació Android permet als usuaris:
- 📺 Consultar pel·lícules i sessions.
- 🎟️ Reservar seients.
- 🔔 Rebre notificacions.

### 🏗 Tecnologies utilitzades
- **Kotlin** → Llenguatge principal.
- **Retrofit** → Per consumir l'API REST.
- **Room** → Per a la gestió de dades locals.
- **Jetpack Compose** → Interfície d'usuari.

---

## 📎 Altres elements importants
- 🧪 **Proves** → Es troben a `tests/Feature` i cobreixen autenticació, rutes públiques i protegides.
- 🐳 **Docker** → Tot el projecte està contenidoritzat.

📌 *Aquesta documentació pot actualitzar-se a mesura que evolucioni el projecte.* 🚀
