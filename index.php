<?php
/**
 * User: Awan Tengah
 * Date: 24/12/2015
 * Time: 19:28
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        .box {
            width: 450px;
            margin: 0 auto;
        }
        .box-form {
            padding: 0.5rem;
            margin: 0.5rem;
        }
        .box-form input, select {
            display: block;
            width: 100%;
            height: 30px;
        }
    </style>
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
<div class="box">
    <h1>Aplikasi cek ongkir sederhana</h1>
    <form method="post" action="cost.php">
        <fieldset>
            <div class="box-form">
                <label>Provinsi Asal
                    <select name="province_origin" class="all_province" onchange="get_city(this);">
                        <option value="">Pilih Provinsi</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Kota/Kabupaten Asal
                    <select name="city_origin" class="city">
                        <option value="">Pilih Kota</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Provinsi Tujuan
                    <select name="province_destination" class="all_province" onchange="get_city(this);">
                        <option value="">Pilih Provinsi</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Kota/Kabupaten Tujuan
                    <select name="city_destination" class="city">
                        <option value="">Pilih Kota</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Berat (gram)
                    <input type="number" name="weight" placeholder="Berat (gram)">
                </label>
            </div>
            <div class="box-form">
                <label>Kurir
                    <select name="courier"">
                        <option value="">Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <input type="submit" value="Submit" onclick="get_cost();">
            </div>
        </fieldset>
    </form>
    <div id="cost"></div>
</div>

<script>
    $(document).ready(function () {
        $.getJSON("province.php", function(all_province) {
            if (all_province) {
                $(".all_province").html("<option value=''>Pilih Provinsi</option>");
                $.each(all_province['rajaongkir']['results'], function (key, value) {
                    $(".all_province").append(
                        "<option value='" + value.province_id + "'>" + value.province + "</option>"
                    );
                });
            }
        })
    });

    function get_city(sel) {
        $.getJSON("city.php?id=" + sel.value, function(get_city) {
            if (get_city) {
                $(".city").html("<option value=''>Pilih Kota</option>");
                $.each(get_city['rajaongkir']['results'], function (key, value) {
                    $(".city").append(
                        "<option value='" + value.city_id + "'>" + value.type + " - " + value.city_name + "</option>"
                    );
                });
            }
        })
    }

    function get_cost() {
        $.getJSON("cost.php", function(cost) {
            console.log(cost);
        });
    }

</script>
</body>
</html>