<?php
/**
 * User: Awan Tengah
 * Date: 23/12/2015
 * Time: 22:56
 */

include_once("raja_ongkir.php");

$raja_ongkir = new Raja_ongkir();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
<h1>Aplikasi cek ongkir sederhana</h1>

<form method="post" action="index.php">
    <fieldset>
        <label>Daftar Provinsi
            <select name="province" id="all_province" onchange="get_city(this);">
                <option value="">Pilih Provinsi</option>
            </select>
        </label>
        <br>
        <label>Daftar Kota/Kabupaten
            <select name="city" id="city">
                <option value="">Pilih Kota</option>
            </select>
        </label>
        <br>
        <label>Berat (gram)
            <input type="number" name="weight" placeholder="Berat (gram)">
        </label>
        <br>
        <input type="submit" value="Submit">
    </fieldset>
</form>
<br><br>
Biaya: <?php echo $raja_ongkir->cost(113, 205, 1700, 'jne'); ?>
<script>
    $(document).ready(function () {
        var all_province = <?php echo $raja_ongkir->get_province(); ?>;
        if (all_province) {
            $("#all_province").html("<option value=''>Pilih Provinsi</option>");
            $.each(all_province['rajaongkir']['results'], function (key, value) {
                $("#all_province").append(
                    "<option value='" + value.province_id + "'>" + value.province + "</option>"
                );
            });
        }
    });

    function get_city(sel) {
        var val = sel.value;
        var get_city = <?php echo $raja_ongkir->get_city(14); ?>;
        if (get_city) {
            $("#city").html("<option value=''>Pilih Kota</option>");
            $.each(get_city['rajaongkir']['results'], function (key, value) {
                $("#city").append(
                    "<option value='" + value.city_id + "'>" + value.type + " - " + value.city_name + "</option>"
                );
            });
        }
    }

</script>
</body>
</html>