# Gemini Project Rules - yousee-indonesia

This document outlines the coding standards, architectural patterns, and development workflows for the `yousee-indonesia` project. Gemini should adhere to these rules when assisting with development.

## 🚀 Project Overview
- **Framework**: Laravel 10
- **Asset Bundling**: Laravel Mix (`webpack.mix.js`)
- **Frontend Stack**: jQuery 3.7.1, Bootstrap 5.3, DataTables 1.13
- **Primary Domain**: Item/Listing management with Vendor/Affiliate system

---

## 🎨 Frontend Guidelines (The "Old Model")

### 1. jQuery & DOM Manipulation
- **Rule**: Use jQuery for all DOM manipulation, event handling, and AJAX calls. Do NOT introduce modern frameworks like Alpine.js or Vue unless explicitly requested.
- **Pattern**:
  ```javascript
  $(document).ready(function() {
      $('#myButton').on('click', function() {
          $.get('/admin/data', function(res) {
              // update DOM
          });
      });
  });
  ```
- **Scripts**: Prefer adding scripts to `@push('scripts')` or `@yield('morejs')` sections in Blade files.

### 2. Styling & Layout
- **Framework**: Bootstrap 5.3.
- **Custom CSS**: Use existing `public/css/admin-genosstyle.v.02.css` and `public/css/style.css`.
- **Icons**: Use Google Material Symbols (Material Symbols Outlined).

### 3. DataTables Integration
- **Server-Side**: Most lists use `yajra/laravel-datatables`.
- **Frontend Pattern**:
  ```javascript
  $('#myTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.data.datatable') }}",
      columns: [ ... ]
  });
  ```

---

## ⚙️ Backend Guidelines

### 1. Controllers & Logic
- **Base Class**: Controllers usually extend `App\Http\Controllers\Controller` or a custom base (check if `CustomController` is needed).
- **Validation**: Perform validation within the controller method using `$request->validate()`.
- **Helpers**: Use existing file upload helpers if available (e.g., `generateImageName`, `uploadImage`).

### 2. Models & Data
- **Naming**: Some models use a `Front` prefix (e.g., `FrontArticle`, `FrontService`) if they are primarily for the landing page.
- **Relationships**: Use standard Eloquent relationships.

### 3. Routing
- **Admin Routing**: Grouped under `admin` prefix with `auth` middleware.
- **Naming**: Use dot notation for route names (e.g., `admin.article.index`).

---

## 🔄 Development Workflows

### 🛠 Adding a New Admin Feature
1. **Model/Migration**: Create model and migration as usual.
2. **Controller**: Create a controller in `app/Http/Controllers/Admin`.
3. **Route**: Add routes in `routes/web.php` under the `admin` group.
4. **View**: Create a Blade file in `resources/views/admin/feature_name`.
   - Extend `admin.base`.
   - Implement `@section('content')`, `@section('morecss')`, and `@section('morejs')`.
5. **DataTables**: Implement the `datatable()` method in the controller and the DataTable JS in the view.

### 🖼 Handling Images
- Images are typically stored in `public/images/`.
- Use the `uploadImage` pattern if the controller extends a helper-enabled base class.

---

## 🤖 Agent Interaction (Antigravity/Gemini)
- **Context Awareness**: Always check `resources/views/admin/base.blade.php` for existing CDN-loaded libraries before suggesting new ones.
- **Mix Commands**: Use `npm run dev` or `npm run watch` for asset compilation. (The project does NOT use `npm run dev` in the Vite sense, but executes Mix).
