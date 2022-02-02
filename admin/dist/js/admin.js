window.onload = () => {
  //HTML elements
  const sidebarLinks = document.querySelectorAll(".nav-treeview .nav-link");
  const btnDone = document.querySelector("#btnDone");
  //get current page
  let currentPageURL = window.location.href;
  if (currentPageURL.indexOf("?") > 0) {
    currentPageURL = currentPageURL.substring(0, currentPageURL.indexOf("?"));
  }

  // Check if element exists before calling function
  const elementExists = (element) => {
    return typeof element !== "undefined" && element !== null;
  };

  //Get current sideBar page==========
  const getCurrentSidebarPage = () => {
    sidebarLinks.forEach((sidebarLink) => {
      sidebarLink.classList.remove("active");
      const currentLink = sidebarLink.href;
      if (currentPageURL === currentLink) {
        //activate link
        sidebarLink.classList.add("active");
        //open sidebar dropdown
        const currentPageHeader = sidebarLink.closest(".sidebar-page-header");
        currentPageHeader.classList.add("menu-open");
        //add blue color to dropdown header
        const sidebarPageTitle = currentPageHeader.querySelector(
          ".sidebar-page-title"
        );
        sidebarPageTitle.classList.add("active");
        //set active icon
        const navIcon = sidebarLink.querySelector(".nav-icon");
        navIcon.classList.remove("fa-circle");
        navIcon.classList.add("fa-dot-circle");
      }
    });
  };

  if (elementExists(sidebarLinks)) {
    getCurrentSidebarPage();
  }
  // #################################

  //Initialize Custom file input
  $(function () {
    bsCustomFileInput.init();
  });

  // CKEditor=======================================
  const body = document.querySelector("#body");
  if (body != undefined && body != null) {
    ClassicEditor.create(body).catch((error) => {
      console.error("There was a problem initializing the editor.", error);
    });
  }
  // ***********************************************************

  // redirect when finished changing fotos
  if (btnDone) {
    btnDone.addEventListener("click", () => {
      window.location = currentPageURL;
    });
  }

  // Blog================
  const blogPostStatusSelect = document.querySelectorAll(".post-status-select");

  const setBlogStatusColor = () => {
    for (statusSelect of blogPostStatusSelect) {
      if (statusSelect.value == "public") {
        statusSelect.style.backgroundColor = "#28a745";
      }
    }
  };

  if (elementExists(blogPostStatusSelect)) {
    setBlogStatusColor();
  }
  // end of window.onload
};

//Dropzone file uploads (must pe outside window.onload area!!! )==============
//upload gallery photos
Dropzone.options.dropzoneFrom = {
  maxFilesize: 4,
  resizeWidth: 1920,
  resizeQuality: 0.8,
  acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
  init: function () {
    myDropzone = this;
    this.on("complete", function () {
      if (
        this.getQueuedFiles().length == 0 &&
        this.getUploadingFiles().length == 0
      ) {
        var _this = this;
        _this.removeAllFiles();
      }
      list_image();
    });
  },
};
//display uploaded files
function list_image() {
  $.ajax({
    url: `upload_gallery_fotos.php`,
    success: function (data) {
      $("#preview").html(data);
    },
  });
}
//display existing images on page load
list_image();

//delete photo
$(document).on("click", ".remove_image", function () {
  var id = $(this).attr("id");
  $.ajax({
    url: `upload_gallery_fotos.php`,
    method: "POST",
    data: { id: id },
    success: function (data) {
      list_image();
    },
  });
});
// #################################################
//upload blog post photos
Dropzone.options.dropzoneBlog = {
  maxFilesize: 4,
  resizeWidth: 1920,
  resizeQuality: 0.8,
  acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
  init: function () {
    myDropzone = this;
    this.on("complete", function () {
      if (
        this.getQueuedFiles().length == 0 &&
        this.getUploadingFiles().length == 0
      ) {
        var _this = this;
        _this.removeAllFiles();
      }
      list_blog_image(post_id.value);
    });
  },
};
//display uploaded files
function list_blog_image(post_id) {
  $.ajax({
    url: `upload_post_fotos.php?post_id=${post_id}`,
    success: function (data) {
      $("#preview").html(data);
    },
  });
}
//display existing images on page load
if (typeof post_id !== "undefined" && post_id !== null) {
  list_blog_image(post_id.value);
}

//delete photo
$(document).on("click", ".remove_blog_image", function () {
  var id = $(this).attr("id");
  $.ajax({
    url: `upload_post_fotos.php?post_id=${post_id.value}`,
    method: "POST",
    data: { id: id },
    success: function (data) {
      list_blog_image(post_id.value);
    },
  });
});
