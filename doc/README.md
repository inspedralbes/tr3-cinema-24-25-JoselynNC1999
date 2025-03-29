# 🎥 **Cinépolis Pedralbes**  

📍 *Gestió de cinema intel·ligent i reserves en línia*  

---
# 📚 Documentació Tècnica del Projecte de Cinema

Aquest document conté la informació tècnica necessària per entendre i treballar amb el projecte del cinema. Inclou detalls sobre els objectius, l'arquitectura, l'entorn de desenvolupament, el desplegament i altres aspectes importants.

---

## 📌 Índex
1. [🎯 Objectius](#-objectius)
2. [🏢 Arquitectura bàsica](#-arquitectura-bàsica)
3. [🛠️ Configuració de l'entorn de desenvolupament](#-configuracio-de-lentorn-de-desenvolupament)
4. [🚀 Desplegament a producció](#-desplegament-a-produccio)
5. [🔌 API: Llistat d'endpoints](#-api-llistat-dendpoints)
6. [📎 Altres elements importants](#-altres-elements-importants)

---

## 🎯 Objectius
L'objectiu principal del projecte és desenvolupar una aplicació completa per a la gestió d'un cinema, que inclogui:
- **Backend**: API REST per gestionar pel·lícules, sessions, seients i reserves.
- **Frontend**: Interfície d'usuari per a clients i administradors.
- **Docker**: Contenidors per facilitar la gestió i desplegament.

---

## 🏢 Arquitectura bàsica

### 📀 Tecnologies utilitzades
- **Backend**:
  - 🏢 Framework: Laravel 10
  - 💽 Base de dades: MySQL
  - 🛠️ Contenidors: Docker
  - 🔑 Autenticació: Laravel Sanctum
  - 📙 Proves: PHPUnit
- **Frontend**:
  - ✨ Framework: Nuxt.js
  - 🔧 Gestió d'estat: Pinia
  - 🎨 Estilització: Tailwind CSS

### 🔄 Interrelació entre els diversos components
- **Backend**: Proporciona una API REST per al frontend i l'aplicació Android.
- **Frontend**: Consumeix l'API per mostrar informació de pel·lícules, sessions i gestionar reserves.
- **Panell d'Administrador**: Està al frontend i requereix autenticació. 
  - **Credencials**: 
    - **Usuari**: `admin.gmail.com`
    - **Contrasenya**: `password`

---

## 🛠️ Configuració de l'entorn de desenvolupament

### 💻 Backend & Frontend (usant Docker)
1. **Clonar el repositori**:
   ```bash
   git clone https://github.com/inspedralbes/tr3-cinema-24-25-JoselynNC1999.git
   cd projecteCinema
   ```
2. **Configurar `.env` i `.env.testing`**
3. **Iniciar tots els contenidors amb Docker**:
   ```bash
   docker-compose up -d
   ```
   *Això arrenca els contenidors de:* 
   - Backend (Laravel)
   - Frontend (Nuxt.js)
   - MySQL
   - Adminer

4. **Executar migracions i llavors**:
   ```bash
   docker exec -it laravel php artisan migrate:fresh --seed
   ```
5. **Executar proves**:
   ```bash
   docker exec -it laravel php artisan test
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
   docker exec -it frontend npm run build
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

### 🎫 Seients
- **GET** `/api/seats` → Llistar seients disponibles.

### 🗓 Reservacions
- **POST** `/api/reservations` → Crear reserva.
- **GET** `/api/reservations` → Llistar reserves.

### 🛠️ Administrador
- **GET** `/admin` → Panell d'administració (requereix autenticació).

---

## 📎 Altres elements importants
- 📙 **Proves** → Es troben a `tests/Feature` i cobreixen autenticació, rutes públiques i protegides.
- 🛠️ **Docker** → Tot el projecte està contenidoritzat.

📅 *Documentació subjecta a actualitzacions.*
