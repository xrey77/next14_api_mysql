<?php

require_once('../../../wp-load.php');
$current_user = wp_get_current_user();
$uname = $current_user->user_login;
$pix = $current_user->user_url;
$getrole = reynald_getCurrent_user_role();
$role = $getrole[0];

if( !is_user_logged_in()) {
    wp_redirect('http://localhost:8090');
    exit();
  }

// contacts_csv_pull();
// echo plugins_url();
$xdate = date(get_option('date_format'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wincor-Nixdord</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>        
    <!-- <script type="text/javascript" src="/wp-content/themes/reynald/assets/js/jquery-3.3.1.min.js"></script> -->
    <!-- <script src="<?php echo plugins_url();?>/client/jquery.js"></script> -->

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">
    <!-- <?php
        if(function_exists('the_custom_logo')) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id);
        }
    ?> -->
  <img class="img-fluid" src="/wp-content/themes/reynald/assets/images/wincor.png" width="90" height="40" />
  <!-- <img class="img-fluid" src="<?php echo $logo[0]; ?>" width="90" height="40" /> -->

</a>

<!-- <?php
  wp_nav_menu(
    array(
        'menu' => 'primary',
        'container' => '',
        'theme_location' => 'primary',
        'items_wrap' => '<ul id="xrey" class="navbar-nav flex-column text-sm-center text-md-left">&3$</ul>'
    )
  );
?> -->

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link lposition" href="/wp-content/themes/reynald/aboutus.php"><i class="fas fa-building"></i>&nbsp;About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link lposition" href="/wp-content/themes/reynald/services.php"><i class="fab fa-servicestack text-dark"></i>&nbsp;Services</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/atm.php">ATM Full Function</a>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/ats.php">ATS - Automated Teller Safe</a>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/banking.php">Banking Solutions</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/atm_chart.php">ATM Deployment Graph</a>
          <a class="dropdown-item text-right" href="/wp-content/themes/reynald/contact_to_excel.php">Export Contacts to EXCEL</a>

        </div>
      </li>

      <?php if( ! empty(trim($current_user->user_login))) { ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/contact_mgt.php">Contact Management</a>
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/product_mgt.php">Product Management</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-right" href="/wp-content/themes/reynald/services_mgt.php">Services Management</a>
            </div>
          </li>

      <?php } ?>

      <?php
      
      if( empty($uname) )
      {?>
          <li class="nav-item" style="margin-left:400px;">
          <!-- <a class="nav-link text-right" href="<?= home_url('/login') ?>">Login</a> -->
                <a id="login" onclick="xlogin()" class="nav-link text-right">Login</a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link text-right" href="<?= site_url('/wp-login.php?action=register&redirect_to=' . get_permalink()); ?>">Register</a> -->
            <a id="register" onclick="xregister()" class="nav-link text-right">Register</a>
          </li>
          <?php
      }
      else 
      //$role
      {  ?>



      <li class="nav-item dropdown"  style="margin-left:250px;">
        <a class="nav-link dropdown-toggle lposition" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span>
          <?php 
            if (empty($pix)) {
                // echo get_avatar( $current_user->user_email, 32 );
                echo '<img style="border-radius:50px;" src="/wp-content/themes/reynald/assets/images/pix.png" width="40p" height="40"  />';

            } else {
              echo '<img style="border-radius:50px;" src=' .  $pix . ' width="40p" height="40"  />';
            }
            $current_user = wp_get_current_user();
            echo '&nbsp;' . $current_user->user_login;

          ?>
          </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        
          <a href="/wp-content/themes/reynald/user_logout.php" class="dropdown-item lposition" ><i class="fas fa-sign-out-alt"></i>&nbsp;Log-Out</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item lposition" href="/wp-content/themes/reynald/user_profile.php"><i class="fas fa-id-badge"></i>&nbsp;Profile</a>

        </div>
      </li>

        <?php
      }
      ?>
    </ul>


 </div>
 </nav>    




<!---START PRINTING OPTION-->
<button class="btn-sm btn-primary" style="margin-left:10px;" id="excel" onClick ="$('#dataTable').tableExport({type:'excel',escape:'false'});">EXPORT TO XLS</button>
<button class="btn-sm btn-success" id="print">PRINT PREVIEW</button>

<div id="dataTable">
<div style="text-align:center;font-size:20px;">CONTACT SUMMARY LIST</div>
<div style="text-align:center;font-size:20px;margin-bottom:30px;">As of&nbsp;<?= $xdate; ?></div>
<table class="table table-sm table-hover">
  <thead class="thead-dark">
    <tr id="xls"><td>&nbsp;</td><td>Contact Summary as of&nbsp;<?= $xdate ?><td><td>&nbsp;</td></tr>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Contact Name</th>
      <th scope="col">Business Address</th>
      <th scope="col">Email Address</th>
    </tr>
  </thead>
  <tbody>


<!-- <table class="dash-table" width="100%" cellspacing="0" cellpadding="10px" border="0" id="dataTable"> -->
<?php
   $query = "SELECT id, contact_name, contact_address, contact_email FROM wp_contacts";
   $results = $wpdb->get_results( $query . " ORDER BY id" );
    if ($results) {
        foreach ( $results as $data ) {
            echo '<tr><td>' . $data->id . '</td><td id="contactName">' . $data->contact_name . '</td><td>' . $data->contact_address . '</td><td>' . $data->contact_email . '</td>';
        }
    }
    
  ?>


</table>
<div>

<script type="text/javascript">
$('#xls').hide();
//table2excel.js
;(function ( $, window, document, undefined ) {
    var pluginName = "table2excel",

    defaults = {
        exclude: ".noExl",
                name: "Table2Excel"
    };

    // The actual plugin constructor
    function Plugin ( element, options ) {
            this.element = element;
            this.settings = $.extend( {}, defaults, options );
            this._defaults = defaults;
            this._name = pluginName;
            this.init();
    }

    Plugin.prototype = {
        init: function () {
            var e = this;

            e.template = {
                head: "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets>",
                sheet: {
                    head: "<x:ExcelWorksheet><x:Name>",
                    tail: "</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>"
                },
                mid: "</x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body>",
                table: {
                    head: "<table>",
                    tail: "</table>"
                },
                foot: "</body></html>"
            };

            e.tableRows = [];

            // get contents of table except for exclude
            $(e.element).each( function(i,o) {
                var tempRows = "";
                $(o).find("tr").not(e.settings.exclude).each(function (i,o) {
                    tempRows += "<tr>" + $(o).html() + "</tr>";
                });
                e.tableRows.push(tempRows);
            });

            e.tableToExcel(e.tableRows, e.settings.name);
        },

        tableToExcel: function (table, name) {
            var e = this, fullTemplate="", i, link, a;

            e.uri = "data:application/vnd.ms-excel;base64,";
            e.base64 = function (s) {
                return window.btoa(unescape(encodeURIComponent(s)));
            };
            e.format = function (s, c) {
                return s.replace(/{(\w+)}/g, function (m, p) {
                    return c[p];
                });
            };
            e.ctx = {
                worksheet: name || "Worksheet",
                table: table
            };

            fullTemplate= e.template.head;

            if ( $.isArray(table) ) {
                for (i in table) {
                    //fullTemplate += e.template.sheet.head + "{worksheet" + i + "}" + e.template.sheet.tail;
                    fullTemplate += e.template.sheet.head + "Table" + i + "" + e.template.sheet.tail;
                }
            }

            fullTemplate += e.template.mid;

            if ( $.isArray(table) ) {
                for (i in table) {
                    fullTemplate += e.template.table.head + "{table" + i + "}" + e.template.table.tail;
                }
            }

            fullTemplate += e.template.foot;

            for (i in table) {
                e.ctx["table" + i] = table[i];
            }
            delete e.ctx.table;

            if (typeof msie !== "undefined" && msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
            {
                if (typeof Blob !== "undefined") {
                    //use blobs if we can
                    fullTemplate = [fullTemplate];
                    //convert to array
                    var blob1 = new Blob(fullTemplate, { type: "text/html" });
                    window.navigator.msSaveBlob(blob1, getFileName(e.settings) );
                } else {
                    //otherwise use the iframe and save
                    //requires a blank iframe on page called txtArea1
                    txtArea1.document.open("text/html", "replace");
                    txtArea1.document.write(e.format(fullTemplate, e.ctx));
                    txtArea1.document.close();
                    txtArea1.focus();
                    sa = txtArea1.document.execCommand("SaveAs", true, getFileName(e.settings) );
                }

            } else {
                link = e.uri + e.base64(e.format(fullTemplate, e.ctx));
                a = document.createElement("a");
                a.download = getFileName(e.settings);
                a.href = link;

                document.body.appendChild(a);

                a.click();

                document.body.removeChild(a);
            }

            return true;
        }
    };

    function getFileName(settings) {
        return ( settings.filename ? settings.filename : "table2excel") + ".xls";
    }

    $.fn[ pluginName ] = function ( options ) {
        var e = this;
            e.each(function() {
                if ( !$.data( e, "plugin_" + pluginName ) ) {
                    $.data( e, "plugin_" + pluginName, new Plugin( this, options ) );
                }
            });

        // chain jQuery functions
        return e;
    };

})( jQuery, window, document );


$("#excel").click(function(){
    $('#xls').show();
    $("#dataTable").table2excel({
            exclude: ".noExl",
    name: "Excel Document customers"
    }); 
    $('#xls').hide();
});

function printData()
{
   var divToPrint=document.getElementById("dataTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('#print').on('click',function(){
printData();
})
 </script>


</body>
</html>






 <!-- <script src="<?php echo plugins_url();?>/client/tableExport.js"></script>     -->

