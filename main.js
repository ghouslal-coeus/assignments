$(document).ready(function() {

    window.initializedataTable();

    window.selectTableRow();

    window.deleteTableRow();

    window.restrictCharacters();
    
} );

function initializedataTable () {

    $('#ip_datatable').DataTable({
        "paging": false,
        "lengthChange": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "sDom": 'lfrtip'    
    });

}

function selectTableRow () {

    $('#ip_datatable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            $('#ip_datatable').DataTable().$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

}

function deleteTableRow () {

    $('#remove_button').click( function () {

        var table = $('#ip_datatable').DataTable();

        if ( table.data().count()  && table.rows( '.selected' ).count()) {

            table.row('.selected').remove().draw( false );
            
            window.sendBrowserNotification();
        }
    });

}

function restrictCharacters () {

    $('#ip_address').bind('keypress', function(e) {
        
        if (e.which < 46 || e.which == 47 || (e.which > 57 && e.which < 65) || (e.which > 90 && e.which < 97) || e.which > 122) {

            e.preventDefault();
        }
    }); 

}

function validateIpAddress () {


    var validIpPattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
    
    var form = document.getElementById('ip_form')
    var ipError = document.getElementById('ip_error');

    if (form.ip_address.value.match(validIpPattern)) {
        
        ipError.innerHTML = "";
        this.loadDoc(form.ip_address.value);
        
        return false;

    } else {

        var ipError = document.getElementById('ip_error');

        ipError.innerHTML = "You have entered an invalid IP address!";
        ipError.style.color = 'red';

        return false;
    }
 }

    function loadDoc(ip) {

        var url = 'http://ip-api.com/json/';
        url += ip;

        var self = this;
        $.getJSON(url, function(data) {

            if(data){
                self.addData(data);
            }

        });
    }
 
    function addData(data){

        document.getElementsByClassName('data_table')[0].style.display = 'block';

        $('#ip_datatable').DataTable().row.add( [
            data.country,
            data.country,
            data.countryCode
         ] ).draw(false);
    }

    function sendBrowserNotification(){

        if (Notification.permission !== "granted") {

            Notification.requestPermission();
            
        } else{

            new Notification('Item Deleted!', {
                body: "Data table row removed",
            });
        }
    }
        
    
