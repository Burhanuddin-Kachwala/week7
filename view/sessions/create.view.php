<!DOCTYPE html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>

<body class="bg-gray-900 text-white h-full">
<?php require base_path('partials/banner.php') ?>
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900 text-white"><?= $heading?></h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="/sessions" method="POST">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900 text-white">Email address</label>
        <div class="mt-2">
          <input type="email" name="email" id="email" autocomplete="email"  value="<?= old('email') ?>" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
        <?php if(isset($errors['email'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['email']; ?></p>
                <?php endif; ?>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900 text-white">Password</label>
          <!-- <div class="text-sm">
            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
          </div> -->
        </div>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>
      <?php if(isset($errors['password'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['password']; ?></p>
                <?php endif; ?>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
      </div>
    </form>

    <!-- <p class="mt-10 text-center text-sm/6 text-gray-500">
      Not a member?
      <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Start a 14 day free trial</a>
    </p> -->
  </div>
</div>

</body>
</html>