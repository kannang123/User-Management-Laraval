<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>

  <h2>Dasboard</h2>
  <h3> Welcome <?php echo e($userData[0]->name); ?></h3>
  <a class="nav-link" href="<?php echo e(route('login')); ?>">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="ti ti-logout icon"></i>
    </span>
    <span class="nav-link-title">
      Logout
    </span>
  </a>
  <table id="example" class="fixed_headers">
    <thead>
      <tr>
        <th>Database Name</th>
        <th>User Name</th>
        <th>Email Id</th>
        <th>Mobile Number</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo e($cleanedEmail); ?> </td>
        <td><?php echo e($userData[0]->name); ?> </td>
        <td><?php echo e($userData[0]->email); ?> </td>
        <td><?php echo e($userData[0]->mobile); ?> </td>
        <td><?php echo e($userData[0]->address); ?> </td>
      </tr>
    </tbody>
  </table>

</body>

<style>
  :root {
    --header-background-color: #333;
    --header-text-color: #FDFDFD;
    --alternate-row-background-color: #DDD;

    --table-width: 750px;
    --table-body-height: 300px;
    --column-one-width: 200px;
    --column-two-width: 200px;
    --column-three-width: 350px;
  }

  .fixed_headers {
    width: var(--table-width);
    table-layout: fixed;
    border-collapse: collapse;
  }

  .fixed_headers th {
    text-decoration: underline;
  }

  .fixed_headers th,
  .fixed_headers td {
    padding: 5px;
    text-align: left;
  }

  .fixed_headers td:nth-child(1),
  .fixed_headers th:nth-child(1) {
    min-width: var(--column-one-width);
  }

  .fixed_headers td:nth-child(2),
  .fixed_headers th:nth-child(2) {
    min-width: var(--column-two-width);
  }

  .fixed_headers td:nth-child(3),
  .fixed_headers th:nth-child(3) {
    width: var(--column-three-width);
  }

  .fixed_headers thead {
    background-color: var(--header-background-color);
    color: var(--header-text-color);
  }

  .fixed_headers thead tr {
    display: block;
    position: relative;
  }

  .fixed_headers tbody {
    display: block;
    overflow: auto;
    width: 100%;
    height: var(--table-body-height);
  }

  .fixed_headers tbody tr:nth-child(even) {
    background-color: var(--alternate-row-background-color);
  }

  .old_ie_wrapper {
    height: var(--table-body-height);
    width: var(--table-width);
    overflow-x: hidden;
    overflow-y: auto;
  }

  .old_ie_wrapper tbody {
    height: auto;
  }

  .nav-link {
  display: block;
  padding: 0.5rem 0.75rem;
  color: inherit;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;   
   padding-left: 37%;
    margin-bottom: 12px;
    
 }
  @media (prefers-reduced-motion: reduce) {
    .nav-link {
      transition: none; } }
  .nav-link:hover, .nav-link:focus {
    color: #1a569d;
    text-decoration: none; }
  .nav-link.disabled {
    color: #475569;
    pointer-events: none;
    cursor: default; }
</style><?php /**PATH /var/www/html/user-registration/resources/views/user/dasboard.blade.php ENDPATH**/ ?>