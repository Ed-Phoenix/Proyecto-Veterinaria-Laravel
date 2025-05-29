# 🐾 Veterinaria WebApp

Aplicación web desarrollada con **Laravel 12**, **Livewire**, **TailwindCSS**, diseñada para gestionar una clínica veterinaria, con funcionalidades para **usuarios**, **veterinarios** y **administradores**.

![Banner Veterinaria](https://placehold.co/1200x400?text=Veterinaria+WebApp+%7C+Laravel+12+Project)

---

## 🚀 Características principales

### 👤 Usuarios (Personas)
- Registro e inicio de sesión.
- CRUD de mascotas (nombre, edad, especie, raza, sexo).
- Agenda de citas:
  - Selección de mascota, veterinario y horario disponible.
  - Horarios mostrados como cuadrícula (solo disponibles).
- Tienda online:
  - Catálogo de productos en cards (imagen, descripción, precio).
  - Carrito de compras con integración a PayPal.
- Notificación por correo al veterinario al agendar una cita.

### 🩺 Veterinarios
- Creados por el administrador.
- Definición de horarios de disponibilidad.
- Panel de citas solicitadas y confirmadas.
- Confirmación y seguimiento de citas.
- Registro de anotaciones clínicas y generación de reportes en PDF.
- Acceso al catálogo de productos.

### 🛠️ Administrador
- CRUD de veterinarios.
- CRUD de productos en venta.

---

## 🧩 Estructura del Proyecto

- **Laravel 12**: Framework backend.
- **Livewire**: Componentes dinámicos sin JavaScript.
- **Tailwind CSS**: Estilizado rápido y moderno.
- **MySQL**: Base de datos relacional.
- **PayPal API**: Pasarela de pagos.
- **DomPDF**: Generación de reportes en PDF.
- **Mail**: Envío de notificaciones por correo electrónico.

---

## 🗃️ CRUDs implementados

| Módulo       | Responsable       | Tecnología    |
|--------------|-------------------|---------------|
| Usuarios     | Laravel Breeze    | Built-in      |
| Mascotas     | Persona           | Livewire      |
| Citas        | Persona/Veterinario | Livewire   |
| Horarios     | Veterinario       | Livewire      |
| Veterinarios | Administrador     | Livewire      |
