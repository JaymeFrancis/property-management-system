<?php
    if(isset($_SESSION['alert']) && $_SESSION['alertCode']) :
?>

<script>
        Swal.fire({
  text: "<?= $_SESSION['alert'] ?>",
  icon: "<?= $_SESSION['alertCode'] ?>",
});
</script>

<?php 
    unset($_SESSION['alert']);
    endif;
?>

<script>
    $('#logout').on('click', function(event){
    event.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
        text: "Do you really want to Log out?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        confirmButtonColor: 'red',
        focusCancel: true,
        returnFocus: false,
    }).then((result) => {
        if(result.value){
            document.location.href = href;
        }
    })
})
</script>