<?php if (isset($component)) { $__componentOriginal1e6834b7596effc838ab3adb1475b477 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1e6834b7596effc838ab3adb1475b477 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.guest','data' => ['title' => 'Login']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.guest'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Login']); ?>

    <div class="card bg-base-100 shadow-2xl rounded-2xl w-full max-w-[420px]">
        <div class="card-body my-2 p-[40px]">

            
            <div class="text-center mb-8">
                <img src="<?php echo e(asset('images/logo-bengkot.png')); ?>"
                    class="w-[60px] h-[60px] rounded-[16px] object-cover mx-auto mb-[14px] block">

                <h1 class="text-[1.5rem] font-extrabold text-[#1e2d6b] m-0 mb-[6px]">
                    Poliklinik
                </h1>

                <p class="text-[0.83rem] text-slate-400 m-0">
                    Masuk ke akun Anda
                </p>
            </div>


            
            <?php if($errors->any()): ?>
            <div class="alert alert-error mb-5 rounded-xl text-[0.83rem]">
                <i class="fas fa-circle-xmark"></i>
                <span><?php echo e($errors->first()); ?></span>
            </div>
            <?php endif; ?>


            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>


                
                <div class="form-control mb-4">

                    <label class="label pb-1">
                        <span class="text-[0.82rem] font-semibold text-gray-700">
                            Email
                        </span>
                    </label>

                    <label class="input input-bordered flex items-center gap-3 rounded-[10px] border-slate-200 bg-slate-50">
                        <i class="fas fa-envelope text-slate-400 text-[0.82rem]"></i>

                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Masukkan email..."
                            class="grow bg-transparent text-slate-800 text-[0.88rem]" required>
                    </label>

                </div>


                
                <div class="form-control mb-6">

                    <label class="label pb-1">
                        <span class="text-[0.82rem] font-semibold text-gray-700">
                            Password
                        </span>
                    </label>

                    <label class="input input-bordered flex items-center gap-3 rounded-[10px] border-slate-200 bg-slate-50">
                        <i class="fas fa-lock text-slate-400 text-[0.82rem]"></i>

                        <input type="password" name="password" id="password_login" placeholder="Masukkan password..."
                            class="grow bg-transparent text-slate-800 text-[0.88rem]" required>

                        <i class="fas fa-eye text-slate-400 text-[0.82rem] cursor-pointer" id="toggle_login"
                            onclick="togglePassword('password_login', 'toggle_login')"></i>

                    </label>

                </div>


                
                <button type="submit" class="btn-primary-gradient mt-6">
                    <i class="fas fa-right-to-bracket"></i>
                    Login
                </button>

            </form>


            
            <p class="text-center mt-5 text-[0.83rem] text-slate-400">
                Belum punya akun?
                <a href="<?php echo e(route('register')); ?>" class="text-[#2d4499] font-bold no-underline">
                    Register
                </a>
            </p>

        </div>
    </div>


    <?php $__env->startPush('scripts'); ?>
    <script>
        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } 
            else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }

        }

    </script>
    <?php $__env->stopPush(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1e6834b7596effc838ab3adb1475b477)): ?>
<?php $attributes = $__attributesOriginal1e6834b7596effc838ab3adb1475b477; ?>
<?php unset($__attributesOriginal1e6834b7596effc838ab3adb1475b477); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1e6834b7596effc838ab3adb1475b477)): ?>
<?php $component = $__componentOriginal1e6834b7596effc838ab3adb1475b477; ?>
<?php unset($__componentOriginal1e6834b7596effc838ab3adb1475b477); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\poliklinik-app\resources\views/auth/login.blade.php ENDPATH**/ ?>