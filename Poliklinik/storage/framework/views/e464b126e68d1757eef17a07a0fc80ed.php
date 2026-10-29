<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Poliklinik'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js','resources/css/app.css']); ?>
</head>

<body>

    <div class="app-wrapper">

        
        <div id="appSidebar" class="sidebar-fixed">
            <?php echo $__env->make('components.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        
        <div class="main-content">

            <?php echo $__env->make('components.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="main-scroll">

                <?php if(session('success')): ?>
                <div class="alert alert-success mb-4 rounded-xl shadow-sm">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo e(session('success')); ?></span>
                </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                <div class="alert alert-error mb-4 rounded-xl shadow-sm">
                    <i class="fas fa-circle-xmark"></i>
                    <span><?php echo e(session('error')); ?></span>
                </div>
                <?php endif; ?>

                <?php echo e($slot); ?>


            </div>

            <?php echo $__env->make('components.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </div>

    </div>

    <script>
        function toggleSidebar(){
            const sidebar=document.getElementById('appSidebar')
            const overlay=document.getElementById('sidebarOverlay')

            sidebar.classList.toggle('open')

            overlay.style.display=
            sidebar.classList.contains('open')
            ? 'block'
            : 'none'
        }

        function toggleFullscreen(){
            const icon=document.getElementById('fsIcon')

            if(!document.fullscreenElement){
                document.documentElement.requestFullscreen()
                icon.className='fas fa-compress'
            }
            else{
                document.exitFullscreen()
                icon.className='fas fa-expand'
            }
        }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>