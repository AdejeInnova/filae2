<script>
    //Events Modal Bootstrap
    $('#ModalCalles').on('show.bs.modal', function (event) {
        //var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this);
        //Title
        modal.find('.modal-title').text('Buscador de Calles:');

        //Body
        //modal.find('.modal-body').html('');

        //Footer
        modal.find('.btn-primary').remove();

    });
</script>