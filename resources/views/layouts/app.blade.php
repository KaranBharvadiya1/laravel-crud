<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    
    <!-- DNS prefetch -->
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    
    <!-- Tailwind with just-in-time -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    transitionProperty: {
                        'width': 'width',
                        'spacing': 'margin, padding',
                    },
                    transitionDuration: {
                        '400': '400ms',
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom smooth scroll -->
    <style>
        html {
            scroll-behavior: smooth;
        }
        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
        }
        .will-change-transform {
            will-change: transform;
        }
    </style>
</head>

<body class="bg-gray-50 antialiased flex flex-col min-h-screen">
    <!-- Header with subtle animation -->
    <header class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300 will-change-transform">
        <div class="container mx-auto px-4 py-4 md:py-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 transform transition-transform hover:scale-[1.01]">
                <i class="fas fa-rocket mr-2 text-blue-600 transition-colors hover:text-blue-700"></i>
                Welcome to My Laravel App
            </h1>
        </div>
    </header>

    <!-- Main content with fade-in effect -->
    <main class="flex-grow container mx-auto px-4 py-8 opacity-0 animate-fadeIn">
        @yield('content')
        
        <!-- Loading spinner placeholder -->
        <div id="loading-spinner" class="fixed inset-0 bg-white bg-opacity-70 flex items-center justify-center z-50 hidden">
            <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-600"></div>
        </div>
    </main>

    <!-- Footer with staggered animations -->
    <footer class="bg-gray-800 text-white py-8 transform transition-all hover:-translate-y-1">
        <div class="container mx-auto px-4">
            <div class="border-t border-gray-700 pt-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="mb-4 md:mb-0 transition-opacity hover:opacity-90">
                        <p class="animate-slideUp">&copy; {{ date('Y') }} My Laravel App</p>
                        <p class="text-gray-400 text-sm animate-slideUp" style="animation-delay: 0.1s">All rights reserved.</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-110" style="transition-delay: 0.05s">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-110" style="transition-delay: 0.1s">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Custom animations -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out forwards;
        }
        .animate-slideUp {
            animation: slideUp 0.5s ease-out forwards;
        }
        
        /* Reduced motion alternative */
        @media (prefers-reduced-motion: reduce) {
            .animate-fadeIn,
            .animate-slideUp {
                animation: none;
                opacity: 1;
            }
        }
    </style>

    <!-- Smooth page transitions -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Fade in page
            document.querySelector('main').style.opacity = '1';
            
            // Smooth anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
            
            // Show loading spinner during AJAX requests
            if (window.livewire) {
                window.livewire.on('loading', () => {
                    document.getElementById('loading-spinner').classList.remove('hidden');
                });
                window.livewire.on('loaded', () => {
                    document.getElementById('loading-spinner').classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>