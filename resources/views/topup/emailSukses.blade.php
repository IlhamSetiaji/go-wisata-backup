<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title></title>
</head>

<body
    style="-moz-box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-box-sizing:border-box;-webkit-text-size-adjust:100%;Margin:0;box-sizing:border-box;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <style>
        @media only screen {
            html {
                min-height: 100%;
                background: #f3f3f3
            }
        }

        @media only screen and (max-width:600px) {
            .small-float-center {
                margin: 0 auto !important;
                float: none !important;
                text-align: center !important
            }

            .small-text-center {
                text-align: center !important
            }

            .small-text-left {
                text-align: left !important
            }

            .small-text-right {
                text-align: right !important
            }
        }

        @media only screen and (max-width:600px) {
            table.body table.container .hide-for-large {
                display: block !important;
                width: auto !important;
                overflow: visible !important
            }
        }

        @media only screen and (max-width:600px) {
            table.body table.container .row.hide-for-large {
                display: table !important;
                width: 100% !important
            }
        }

        @media only screen and (max-width:600px) {
            table.body table.container .show-for-large {
                display: none !important;
                width: 0;
                mso-hide: all;
                overflow: hidden
            }
        }

        @media only screen and (max-width:600px) {
            table.body img {
                width: auto !important;
                height: auto !important
            }

            table.body center {
                min-width: 0 !important
            }

            table.body .container {
                width: 95% !important
            }

            table.body .column,
            table.body .columns {
                height: auto !important;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding-left: 20px !important;
                padding-right: 20px !important
            }

            table.body .column .column,
            table.body .column .columns,
            table.body .columns .column,
            table.body .columns .columns {
                padding-left: 0 !important;
                padding-right: 0 !important
            }

            table.body .collapse .column,
            table.body .collapse .columns {
                padding-left: 0 !important;
                padding-right: 0 !important
            }

            td.small-1,
            th.small-1 {
                display: inline-block !important;
                width: 8.33333% !important
            }

            td.small-2,
            th.small-2 {
                display: inline-block !important;
                width: 16.66667% !important
            }

            td.small-3,
            th.small-3 {
                display: inline-block !important;
                width: 25% !important
            }

            td.small-4,
            th.small-4 {
                display: inline-block !important;
                width: 33.33333% !important
            }

            td.small-5,
            th.small-5 {
                display: inline-block !important;
                width: 41.66667% !important
            }

            td.small-6,
            th.small-6 {
                display: inline-block !important;
                width: 50% !important
            }

            td.small-7,
            th.small-7 {
                display: inline-block !important;
                width: 58.33333% !important
            }

            td.small-8,
            th.small-8 {
                display: inline-block !important;
                width: 66.66667% !important
            }

            td.small-9,
            th.small-9 {
                display: inline-block !important;
                width: 75% !important
            }

            td.small-10,
            th.small-10 {
                display: inline-block !important;
                width: 83.33333% !important
            }

            td.small-11,
            th.small-11 {
                display: inline-block !important;
                width: 91.66667% !important
            }

            td.small-12,
            th.small-12 {
                display: inline-block !important;
                width: 100% !important
            }

            .column td.small-12,
            .column th.small-12,
            .columns td.small-12,
            .columns th.small-12 {
                display: block !important;
                width: 100% !important
            }

            table.body td.small-offset-1,
            table.body th.small-offset-1 {
                margin-left: 8.33333% !important;
                Margin-left: 8.33333% !important
            }

            table.body td.small-offset-2,
            table.body th.small-offset-2 {
                margin-left: 16.66667% !important;
                Margin-left: 16.66667% !important
            }

            table.body td.small-offset-3,
            table.body th.small-offset-3 {
                margin-left: 25% !important;
                Margin-left: 25% !important
            }

            table.body td.small-offset-4,
            table.body th.small-offset-4 {
                margin-left: 33.33333% !important;
                Margin-left: 33.33333% !important
            }

            table.body td.small-offset-5,
            table.body th.small-offset-5 {
                margin-left: 41.66667% !important;
                Margin-left: 41.66667% !important
            }

            table.body td.small-offset-6,
            table.body th.small-offset-6 {
                margin-left: 50% !important;
                Margin-left: 50% !important
            }

            table.body td.small-offset-7,
            table.body th.small-offset-7 {
                margin-left: 58.33333% !important;
                Margin-left: 58.33333% !important
            }

            table.body td.small-offset-8,
            table.body th.small-offset-8 {
                margin-left: 66.66667% !important;
                Margin-left: 66.66667% !important
            }

            table.body td.small-offset-9,
            table.body th.small-offset-9 {
                margin-left: 75% !important;
                Margin-left: 75% !important
            }

            table.body td.small-offset-10,
            table.body th.small-offset-10 {
                margin-left: 83.33333% !important;
                Margin-left: 83.33333% !important
            }

            table.body td.small-offset-11,
            table.body th.small-offset-11 {
                margin-left: 91.66667% !important;
                Margin-left: 91.66667% !important
            }

            table.body table.columns td.expander,
            table.body table.columns th.expander {
                display: none !important
            }

            table.body .right-text-pad,
            table.body .text-pad-right {
                padding-left: 10px !important
            }

            table.body .left-text-pad,
            table.body .text-pad-left {
                padding-right: 10px !important
            }

            table.menu {
                width: 100% !important
            }

            table.menu td,
            table.menu th {
                width: auto !important;
                display: inline-block !important
            }

            table.menu.small-vertical td,
            table.menu.small-vertical th,
            table.menu.vertical td,
            table.menu.vertical th {
                display: block !important
            }

            table.menu[align=center] {
                width: auto !important
            }
        }

    </style>
    <!--[if gte mso 9]>
  <style>
  li {text-indent: -1em;}
  </style>
  <![endif]-->
  <?php $topup = DB::table('top_up')->where('user_id',Auth::user()->id)->where('keterangan','Sudah Terbayar, Saldo Sudah Ditambahkan')->OrderBy('id','DESC')->first() ?>
    <table class="body"
        style="Margin:0;background:#f3f3f3;border-collapse:collapse;border-spacing:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
        <tr style="padding:0;text-align:left;vertical-align:top">
            <td class="center" align="center" valign="top"
                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                <center data-parsed="" style="min-width:580px;width:100%">
                    <table class="container float-center"
                        style="Margin:0 auto;background:#fefefe;background-color:#fff;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px">
                        <tbody>
                            <tr style="padding:0;text-align:left;vertical-align:top">
                                <td
                                    style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                    <table class="row header"
                                        style="border-collapse:collapse;border-spacing:0;border-top:6px solid #e6e6e6;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                <table class="spacer"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr
                                                                            style="padding:0;text-align:left;vertical-align:top">
                                                                            <td height="10px"
                                                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                &#xA0;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <h1
                                                                    style="Margin:0;Margin-bottom:10px;color:inherit;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:42px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Top Up Saldo</h1>
                                                                <h3
                                                                    style="Margin:0;Margin-bottom:10px;color:inherit;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:28px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                    Sukses</h3>
                                                                <p class="header-divider"
                                                                    style="Margin:10px 0!important;Margin-bottom:10px;background-color:#d8d8d8;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:1px;line-height:19px;margin:10px 0!important;margin-bottom:10px;max-height:1px;max-width:200px;padding:0;text-align:left;width:200px">
                                                                </p>
                                                                <h6 class="payment-type"
                                                                    style="Margin:0;Margin-bottom:10px;color:inherit;display:inline-block;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:18px;font-style:italic;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;margin-right:15px;padding:0;text-align:left;word-wrap:normal">
                                                                    Top Up Saldo
                                                                </h6>
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="wrapper bg-sub-header" align="center"
                                        style="background-color:#e6e6e6;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="spacer"
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="10px"
                                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                &#xA0;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-6 large-6 columns first"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:10px;text-align:left;width:270px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                            <p class="date-text text-left"
                                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                                Waktu : {{ $topup->updated_at }}</p>
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            <th class="small-6 large-6 columns last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:10px;padding-right:20px;text-align:left;width:270px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                            <p class="order-id-text text-right"
                                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:right">
                                                                                </p>
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="wrapper bg-status-bar" align="center"
                                        style="background-color:#FF9800;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-12 large-12 columns first last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                            <table class="spacer"
                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <td height="10px"
                                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                            &#xA0;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <p class="text-center status-text"
                                                                                style="Margin:0;color:#fff;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0!important;padding:0;text-align:center">
                                                                                <strong>TRANSAKSI SUKSES</strong>
                                                                            </p>
                                                                        </th>
                                                                        <th class="expander"
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>

                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                <table class="spacer"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr
                                                                            style="padding:0;text-align:left;vertical-align:top">
                                                                            <td height="30px"
                                                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:30px;font-weight:400;hyphens:auto;line-height:30px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                &#xA0;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <p
                                                                    style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    {{ $topup->name }},<br /><br />
                                                                    Transaksi TOP UP Saldo anda Berhasil Silahkan Klik Link Sistem Dibawah. </p>
                                                            </th>
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th class="small-12 large-12 columns first last"
                                                    style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                    <table
                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th
                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                <table class="spacer"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr
                                                                            style="padding:0;text-align:left;vertical-align:top">
                                                                            <td height="10px"
                                                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                &#xA0;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table class="order-details" border="0" cellspacing="0"
                                                                    cellpadding="0"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:0;padding-bottom:10px;text-align:left">
                                                                            Deskripsi</th>
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:0;padding-bottom:10px;text-align:right">
                                                                            Transfer</th>
                                                                    </tr>
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <td
                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;hyphens:auto;line-height:19px;margin:0;padding:10px 0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                            -</td>
                                                                        <td
                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:19px;margin:0;padding:10px 0;text-align:right;vertical-align:top;word-wrap:break-word">
                                                                            Rp. {{ number_format($topup->nominal) }}</td>
                                                                    </tr>
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <td
                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;hyphens:auto;line-height:19px;margin:0;padding:10px 0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                            TOTAL</td>
                                                                        <td
                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;hyphens:auto;line-height:19px;margin:0;padding:10px 0;text-align:right;vertical-align:top;word-wrap:break-word">
                                                                            Rp. {{ number_format($topup->nominal_ditransfer) }}</td></td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </th>
                                       
                                                            <th class="expander"
                                                                style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>



                                    <?php $topup_id = DB::table('top_up')->orderBy('id','DESC')->first() ?>
                                    <a href="{{ url('success/'.$topup_id->id) }}"><button class="btn btn-primary mt-4"> Halaman Utama </button></a></center>
                                    <table class="row"
                                        style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                        <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <table class="spacer"
                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="50px"
                                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:50px;font-weight:400;hyphens:auto;line-height:50px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                &#xA0;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="wrapper bg-footer" align="center"
                                        style="background-color:#f3f3f3;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td class="wrapper-inner"
                                                style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table class="row"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <th class="small-12 large-12 columns first last"
                                                                style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                                                <table
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tr
                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                                            <table class="spacer"
                                                                                style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="padding:0;text-align:left;vertical-align:top">
                                                                                        <td height="30px"
                                                                                            style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:30px;font-weight:400;hyphens:auto;line-height:30px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                            &#xA0;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <p class="text-center contact-text"
                                                                                style="Margin:0;Margin-bottom:10px;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:13px;font-weight:400;line-height:19px;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                                Untuk informasi lebih lanjut mengenai
                                                                                pembelian anda, silahkan hubungi:<br>
                                                                                email: <a class="link"
                                                                                    href="mailto:ridwanhiday49@gmail.com"
                                                                                    style="Margin:0;color:#00B4ED;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none">ridwanhiday49@gmail.com</a>
                                                                                | phone: +6281325095629</p>
                                                                        </th>
                                                                        <th class="expander"
                                                                            style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;visibility:hidden;width:0">
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </td>
        </tr>
    </table>
    {{-- <form action="{{url('pending/'.$topup->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="Terbayar">
        <input type="hidden" name="keterangan" value="Sudah Terbayar, Saldo Sudah Ditambahkan">
        <center><button type="submit" class="btn btn-primary mt-4"> Konfirmasi Pembayaran </button></center>
        </form> --}}
    <!-- prevent Gmail on iOS font size manipulation -->
    <div style="display:none;white-space:nowrap;font:15px courier;line-height:0">&#xA0; &#xA0; &#xA0; &#xA0; &#xA0;
        &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;
        &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0; &#xA0;</div>
    <img width="1px" height="1px" alt=""
        src="http://email.mg.midtrans.com/o/eJwdzsFuxCAMBNCvaY4RNpjAgW-JDMa7qIVULFXVv2-019Fo5klScIeFrSU0iMajBW8swh6yd6Ama1UksvThTH_svcmaPF57ufr2TEzFQARG520B9dVmf-9lEMoMBrb1nJXlbJJUCko1EESFQ3SY9T7KKgELQeG7Bi4U6zxVYH9EzZGo3IE5PBy0zTR-5mzyy8PFcHMendvXG7JS5vF5vmVa5_nNf72OdY5rNW2FV7vGP6ADSCM">
</body>

<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('assets/js/main.js') }}"></script>

</html>
