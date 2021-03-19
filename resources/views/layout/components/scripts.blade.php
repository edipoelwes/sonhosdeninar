<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.mask.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>

<!--  Plugin for Sweet Alert -->
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
{{-- <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.1.1') }}" type="text/javascript"></script> --}}
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets/js/paper-dashboard.min.js') }}"></script>


<script src="{{ asset('assets/js/core/functions.js') }}"></script>

<script>
   $(document).ready(function() {
      $('.dataTables').DataTable({
         responsive: true,
         "pageLength": 10,
         "oLanguage": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            // "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoFiltered": "",
            "sSearch": "Buscar:",
            "oPaginate": {
               "sFirst": "Primeiro",
               "sPrevious": "Anterior",
               "sNext": "Seguinte",
               "sLast": "Último"
            }
         }
      })

      // $('div.dataTables_paginate ul.pagination').removeClass('table-bordered')
      // $('div.dataTables_paginate ul.pagination').addClass('justify-content-end mt-3')
   });

</script>

<script>
   $(document).ready(function() {
      $('.select2').select2({
         language: "pt-BR",
         theme: "classic",
         width: 'resolve'
      },

      );
   });

</script>
