# UniRide UI Quick Reference

## 🎨 Color Palette

### Driver Portal Theme
```
Primary Gradient: from-blue-600 to-cyan-600
Hover: from-blue-700 to-cyan-700
Background: bg-gray-50
```

### Admin Portal Theme
```
Primary Gradient: from-indigo-600 to-purple-600
Hover: from-indigo-700 to-purple-700
Background: bg-gray-50
```

### Status Colors
```
Success: bg-green-500
Error: bg-red-500
Warning: bg-yellow-500
Info: bg-blue-500
```

## 📐 Common Components

### Button Styles

#### Primary Button
```html
<button class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-cyan-700 transform hover:scale-[1.02] transition duration-200 shadow-lg">
    Button Text
</button>
```

#### Secondary Button
```html
<button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold transition duration-200">
    Button Text
</button>
```

#### Danger Button
```html
<button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg transition duration-200 font-medium shadow-md">
    Delete
</button>
```

### Form Input
```html
<input type="text" 
    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
    placeholder="Enter text">
```

### Card Container
```html
<div class="bg-white rounded-2xl shadow-xl p-8">
    <!-- Content -->
</div>
```

### Alert Messages

#### Success
```html
<div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
    <div class="flex">
        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <p class="ml-3 text-sm text-green-700">Success message</p>
    </div>
</div>
```

#### Error
```html
<div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
    <div class="flex">
        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <p class="ml-3 text-sm text-red-700">Error message</p>
    </div>
</div>
```

### Table Structure
```html
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-cyan-600">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Header
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        Data
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
```

## 🎯 Page Layouts

### Standard Page Layout
```html
@extends('layouts.app')

@section('content')
@include('layouts.driver-header') <!-- or admin-header -->

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page content -->
    </div>
</div>
@endsection
```

### Form Page Layout
```html
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Form content -->
        </div>
    </div>
</div>
```

## 🔧 Utility Classes

### Spacing
- `p-4` = padding: 1rem
- `px-6` = padding-left/right: 1.5rem
- `py-3` = padding-top/bottom: 0.75rem
- `mb-4` = margin-bottom: 1rem
- `space-x-4` = gap between children: 1rem

### Typography
- `text-sm` = 0.875rem
- `text-base` = 1rem
- `text-lg` = 1.125rem
- `text-xl` = 1.25rem
- `text-2xl` = 1.5rem
- `text-3xl` = 1.875rem
- `text-4xl` = 2.25rem

### Font Weights
- `font-medium` = 500
- `font-semibold` = 600
- `font-bold` = 700

### Rounded Corners
- `rounded-lg` = 0.5rem
- `rounded-xl` = 0.75rem
- `rounded-2xl` = 1rem
- `rounded-full` = 9999px

### Shadows
- `shadow-sm` = small shadow
- `shadow-md` = medium shadow
- `shadow-lg` = large shadow
- `shadow-xl` = extra large shadow
- `shadow-2xl` = 2x large shadow

## 📱 Responsive Design

### Breakpoints
- `sm:` = 640px and up
- `md:` = 768px and up
- `lg:` = 1024px and up
- `xl:` = 1280px and up

### Example
```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Responsive grid -->
</div>
```

## 🎨 Icons

Using Heroicons SVG:
```html
<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
</svg>
```

## 🚀 Quick Tips

1. **Always use gradient backgrounds for primary actions**
2. **Add hover effects with `hover:` prefix**
3. **Use `transition duration-200` for smooth animations**
4. **Include `shadow-lg` for elevated elements**
5. **Use `rounded-lg` or higher for modern look**
6. **Add `transform hover:scale-[1.02]` for interactive elements**
7. **Use proper spacing: `space-y-4` or `gap-4`**
8. **Include focus states: `focus:ring-2 focus:ring-blue-500`**

## 📚 Resources

- Tailwind CSS Docs: https://tailwindcss.com/docs
- Heroicons: https://heroicons.com/
- Color Palette: https://tailwindcss.com/docs/customizing-colors
- Google Fonts (Inter): https://fonts.google.com/specimen/Inter
