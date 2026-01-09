<!-- Alert Container - Fixed Position, No Space Taken -->
<div class="alert-container">
    @if ($message = Session::get('success'))
        <div id="alert-success" class="fixed top-6 right-6 z-[9999] min-w-80 max-w-md p-4 rounded-xl border border-green-200 bg-white dark:bg-gray-800 shadow-2xl animate-slide-in pointer-events-auto"
            role="alert">
            <div class="flex items-start gap-3">
                <div class="shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <svg class="size-5 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="flex-1 pt-0.5">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Berhasil!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $message }}</p>
                </div>
                <button type="button" onclick="closeAlert('alert-success')" class="shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="progress-bar"></div>
        </div>
    @endif
    
    @if ($message = Session::get('error'))
        <div id="alert-error" class="fixed top-6 right-6 z-[9999] min-w-80 max-w-md p-4 rounded-xl border border-red-200 bg-white dark:bg-gray-800 shadow-2xl animate-slide-in pointer-events-auto"
            role="alert">
            <div class="flex items-start gap-3">
                <div class="shrink-0 w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                    <svg class="size-5 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <div class="flex-1 pt-0.5">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Error!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $message }}</p>
                </div>
                <button type="button" onclick="closeAlert('alert-error')" class="shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="progress-bar bg-red-500"></div>
        </div>
    @endif
    
    @if ($message = Session::get('warning'))
        <div id="alert-warning" class="fixed top-6 right-6 z-[9999] min-w-80 max-w-md p-4 rounded-xl border border-yellow-200 bg-white dark:bg-gray-800 shadow-2xl animate-slide-in pointer-events-auto"
            role="alert">
            <div class="flex items-start gap-3">
                <div class="shrink-0 w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                    <svg class="size-5 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3.05h16.94a2 2 0 0 0 1.71-3.05L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div class="flex-1 pt-0.5">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Peringatan!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $message }}</p>
                </div>
                <button type="button" onclick="closeAlert('alert-warning')" class="shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="progress-bar bg-yellow-500"></div>
        </div>
    @endif
    </div>
    
    <style>
        .alert-container {
            position: fixed;
            top: 0;
            right: 0;
            pointer-events: none;
            z-index: 9999;
        }
    
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    
        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
    
        @keyframes progressBar {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }
    
        .animate-slide-in {
            animation: slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
    
        .animate-slide-out {
            animation: slideOut 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    
        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: #10b981;
            border-radius: 0 0 0.75rem 0.75rem;
            animation: progressBar 5s linear;
        }
    
        [id^="alert-"] {
            position: relative;
            overflow: hidden;
        }
    </style>
    
    <script>
        function closeAlert(id) {
            const alert = document.getElementById(id);
            if (alert) {
                alert.classList.remove('animate-slide-in');
                alert.classList.add('animate-slide-out');
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }
    
        // Auto-close alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[id^="alert-"]').forEach(alert => {
                setTimeout(() => {
                    closeAlert(alert.id);
                }, 5000);
            });
        });
    </script>