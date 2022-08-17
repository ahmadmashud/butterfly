<script>
    var base_url = '{{url('/')}}' + '/';
</script>
<script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/metisMenu/dist/metisMenu.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="{{asset('assets/vendors/chart.js/dist/Chart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js')}}" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="{{asset('assets/js/app.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{asset('assets/js/accounting.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.countdown.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>

<!-- PAGE LEVEL SCRIPTS-->
<script type="text/javascript">
    
    $('#addModal').click(function() {
        $("input[type=text], textarea").val("");
    });

    $(function() {
        $('#example-table').DataTable({
            pageLength: 25,
            scrollY: "800px",
            scrollX: true,
            scrollCollapse: true,
        });

        $('#example-table-fixed-column-scrollx').DataTable({
            scrollY: "800px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns: {
                leftColumns: 3,
                rightColumns: 3
            }
        });
    });
</script>


<script type="text/javascript">
    
    function formatMoney(value) {
        return accounting.formatMoney(value, "", 0);
    }

    function unformatMoney(value) {
        return accounting.unformat(value);
    }
    
    function deleteDelimiterMultipleInput(parent, input){
    $(parent).find(input).each(function(){
        var price = $(this).val();
        $(this).val(accounting.unformat(price));
    });
}
</script>

