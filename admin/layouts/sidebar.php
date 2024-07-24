<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link " href="<?= url('admin') ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li lass="nav-item">
      <a class="nav-link " href="<?= admin_url("about") ?>">
        <i class="bi bi-person-fill"></i><span>About me</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#services-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-code-fill"></i><span>Servies</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="services-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= admin_url("services/manage") ?>">
            <i class="bi bi-circle"></i><span>Manage Services</span>
          </a>
        </li>
        <li>
          <a href=" <?= admin_url("services/add") ?>">
            <i class="bi bi-circle"></i><span>Add New Services</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-pencil-square"></i><span>My Blogs</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="blog-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= admin_url("blogs/blogcategory") ?>">
            <i class="bi bi-circle"></i><span>Manage Blogs Category</span>
          </a>
        </li>
        <li>
          <a href=" <?= admin_url("blogs/manageblog") ?>">
            <i class="bi bi-circle"></i><span>Manage Blogs</span>
          </a>
        </li>
        <li>
          <a href="<?= admin_url("blogs/addblog") ?>">
            <i class="bi bi-circle"></i><span>Write Blogs</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#testimonals" data-bs-toggle="collapse" href="#">
        <i class="bi bi-blockquote-left"></i><span>Review</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="testimonals" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href=" <?= admin_url("review/manage") ?>">
            <i class="bi bi-circle"></i><span>Manage Review</span>
          </a>
        </li>
        <li>
          <a href="<?= admin_url("review/add") ?>">
            <i class="bi bi-circle"></i><span>Add New Review</span>
          </a>
        </li>
      </ul>
    </li>
    <li lass="nav-item">
      <a class="nav-link " href="<?= admin_url("client") ?>">
        <i class="bi bi-person-workspace"></i><span>Clients</span>
      </a>
    </li>
    <li lass="nav-item">
      <a class="nav-link " href="<?= admin_url("client") ?>">
        <i class="bi bi-envelope-arrow-down-fill"></i><span>Contact message</span>
      </a>
    </li>
    <li lass="nav-item">
      <a class="nav-link " href="<?= admin_url("gallery/category") ?>">
      <i class="bi bi-images"></i><span>Gallery</span>
      </a>
    </li>
  </ul>

</aside><!-- End Sidebar-->