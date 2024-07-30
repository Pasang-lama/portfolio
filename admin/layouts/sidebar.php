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
          <a href="<?= admin_url("blogs/category") ?>">
            <i class="bi bi-circle"></i><span>Manage Blogs Category</span>
          </a>
        </li>
        <li>
          <a href=" <?= admin_url("blogs/manage") ?>">
            <i class="bi bi-circle"></i><span>Manage Blogs</span>
          </a>
        </li>
        <li>
          <a href="<?= admin_url("blogs/add") ?>">
            <i class="bi bi-circle"></i><span>Write Blogs</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#projects-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-code-slash"></i><span>Projects</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="projects-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= admin_url("project/category") ?>">
            <i class="bi bi-circle"></i><span>Manage Category</span>
          </a>
        </li>
        <li>
          <a href=" <?= admin_url("project/manage") ?>">
            <i class="bi bi-circle"></i><span>Manage Project</span>
          </a>
        </li>
        <li>
          <a href="<?= admin_url("project/add") ?>">
            <i class="bi bi-circle"></i><span>Add New Project</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#qualification" data-bs-toggle="collapse" href="#">
      <i class="bi bi-bank2"></i><span>Qualification</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="qualification" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href=" <?= admin_url("education/manage") ?>">
            <i class="bi bi-circle"></i><span>Manage Qualification</span>
          </a>
        </li>
        <li>
          <a href="<?= admin_url("education/add") ?>">
            <i class="bi bi-circle"></i><span>Add Degree</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#experience" data-bs-toggle="collapse" href="#">
      <i class="bi bi-ui-checks"></i><span>Experience</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="experience" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href=" <?= admin_url("experience/manage") ?>">
            <i class="bi bi-circle"></i><span>Manage Experience</span>
          </a>
        </li>
        <li>
          <a href="<?= admin_url("experience/add") ?>">
            <i class="bi bi-circle"></i><span>Add Experience</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#skills" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layer-forward"></i><span>Skills</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="skills" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href=" <?= admin_url("skill/technical") ?>">
            <i class="bi bi-circle"></i><span>Technical Skills</span>
          </a>
        </li>
        <li>
          <a href="<?= admin_url("skill/softskill") ?>">
            <i class="bi bi-circle"></i><span>Soft skills</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#testimonals" data-bs-toggle="collapse" href="#">
      <i class="bi bi-quote"></i><span>Review</span><i class="bi bi-chevron-down ms-auto"></i>
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
      <a class="nav-link " href="<?= admin_url("message") ?>">
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