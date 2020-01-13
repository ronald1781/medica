   </div>
   <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page 

  <!-- Core Scripts - Include with every page -->
    <script src="asest/admin/js/jquery-3.4.1.js"></script>
    <script src="asest/admin/js/bootstrap.min.js"></script>
    <script src="asest/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="asest/admin/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="asest/admin/js/plugins/morris/morris.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="asest/admin/js/sb-admin.js"></script>
<!-- Page-Level Plugin Scripts - Tables -->
    <script src="asest/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="asest/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="asest/admin/js/demo/dashboard-demo.js"></script>
     <!-- Page-Level Demo Scripts - personalziado - Use for reference -->
      <script src="asest/vendor/js/datepiker/jquery.datetimepicker.js"></script>
      <script src="asest/vendor/js/alertify/alertify.js"></script>
      <script src="asest/vendor/js/alertify/notify.js"></script>
      <script src="asest/vendor/js/datepiker/jquery.datetimepicker.full.min.js"></script>
   <script src="asest/vendor/js/funcionesajax.js"></script>
   <script src="asest/vendor/js/general.js"></script>
<!--
        <script type="text/javascript" language="javascript">
            $(function() {                

                var calendar = $('#calendar').fullCalendar({
                    editable:true,
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    },
                    events:"citas_control/load",
                    selectable:true,
                    selectHelper:true,
                    select:function(start, end, allDay)
                    {
                        var title = prompt("Enter Event Title");
                        if(title)
                        {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url:"citas_control/insert",
                                type:"POST",
                                data:{title:title, start:start, end:end},
                                success:function()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Added Successfully");
                                }
                            })
                        }
                    },
                    editable:true,
                    eventResize:function(event)
                    {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url:"citas_control/update",
                            type:"POST",
                            data:{title:title, start:start, end:end, id:id},
                            success:function()
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Update");
                            }
                        })
                    },
                    eventDrop:function(event)
                    {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url:"citas_control/update",
                            type:"POST",
                            data:{title:title, start:start, end:end, id:id},
                            success:function()
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Updated");
                            }
                        })
                    },
                    eventClick:function(event)
                    {
                        if(confirm("Are you sure you want to remove it?"))
                        {
                            var id = event.id;
                            $.ajax({
                                url:"citas_control/delete",
                                type:"POST",
                                data:{id:id},
                                success:function()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert('Event Removed');
                                }
                            })
                        }
                    }
                });
            });
        </script>-->
        <p class="footer">Cargo en <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'App medical <strong>' . CI_VERSION . '</strong>' : '' ?></p> 
    </body>
    </html>