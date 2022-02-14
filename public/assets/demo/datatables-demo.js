// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#datatablesSimple').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"      
  }, 
  //"ordering":false,
  order: ['0', 'DESC']
  });    
});
