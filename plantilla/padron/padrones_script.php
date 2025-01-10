<script>

$(document).ready(function() {
    $('#ciclo_padron').change(function() {
        let ciclo = $(this).val();
        let formData = {
            ciclo : ciclo,
            api_key: 'VFVWT1RGTnNXV3BUUjNSYVkyNUdlbUl5YUhCamVWWk9Ta2hhUVdKVVNuQmhNV1JIVm1wU05VdHNjRUpYYXpGTVZWVm5kMWRYT0hwUlJWcEZVV3hOTTBwcVJUMD0='
       };

       
        console.log('valor elegido', ciclo);
        let html = '<option value="">Seleccione Curso</option>';
        $.ajax({
        url: 'http://localhost/csc-back/api/padrones/get_cursos.php',
        type: "POST",
        dataType: "json", 
        data: formData,
        success: function(response) {
            if (response.status === 'success') {
                response.curso.forEach((curso, index) => {
                    html += `<option value="${curso}-${response.division[index]}">${curso}-${response.division[index]}</option>`;
                });
                $('#curso_padron').html(html);
            }
        }
        });
    });
});
</script>