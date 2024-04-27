

  // モーダル
  $(document).ready(function() {
    $(".work_image img").click(function() {
      var imgSrc = $(this).attr("src");
      $("#modal-img").attr("src", imgSrc);
      $("#modal").css("display", "block");
    });
  
    // モーダルウィンドウ閉じる処理
    $(".close-button, #modal").click(function() {
      $("#modal").css("display", "none");
    });
  });

  // 削除の時にアラートで確認

 $(document).ready(function() {
  $(".deletebtn").click(function(e) {
    e.preventDefault(); 
// console.log((".deletebtn").length);

    const id = $(this).data("id");
    const confirmMessage = confirm("データを削除しますか？");

    if (confirmMessage) {
      window.location.href = "delete.php?id=" + id;
    }
  });
});

// index.phpのフォーム登録を、ログインしないとできないようにする
$(document).ready(function() {
  $('#wrap').submit(function(event) {
    let userlogin = "<?php echo isset($_SESSION['name']) ? 'true' : 'false'; ?>";
    
    if (!userlogin) {
      alert('Please login to continue.');
      event.preventDefault();
    }
  });
});

