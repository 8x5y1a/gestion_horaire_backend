
# Schedule Manager (Gestion Horaire) Frontend 


## 🔍 Overview

This project is a web-based scheduling assistant built to simplify and automate the creation of academic schedules. It was developed as part of our final-year project in a team of 5 students for a real client: the head of the Techniques de programmation et de cybersécurité program at Cégep de l'Outaouais.

## 🎯 Problem

Our client was responsible for manually creating schedules for all cohorts and teachers while respecting multiple dynamic constraints, such as:

- Classroom availability
- Class size limits
- Teacher schedules and Parental obligations
- Program-specific requirements
- Frequent changes imposed by administration

Managing all of these manually was extremely time-consuming, error-prone, and difficult to visualize.

## 💡 Solution

We built an interactive web application that allows the client to drag and drop schedule elements while the system automatically checks and visualizes constraint violations in real time. This eliminates the need for manual checks, reduces mistakes, and significantly speeds up the scheduling process.

## 🛠️ Tech Stack

Frontend: Angular (Typescript)

Backend: Laravel (PHP)

Database: MySQL

## ✨ Key Features

- 📌 Drag-and-drop schedule editor
- ⚠️ Automatic constraint detection and warnings
- 👀 Clear visualization of teacher/class availability
- 👤 User-friendly interface—no programming required
- 🔄 Supports frequent and dynamic scheduling changes
- 💾 Saves and loads multiple schedule configurations

## Run Locally

### FrontEnd

```bash
  npm install
```

Start the server

```bash
  npm run start
```
### Backend

Open MySQL (XAMPP)

Seeding the database

```bash
  php artisan migrate:fresh --seed
```

Start the server

```bash
  php artisan serve
```


## Related
This project was made in Autumn 2023

[Frontend Repository](https://github.com/8x5y1a/gestion_horaire_frontend)

