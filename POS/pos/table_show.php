<div class="row show-product table-container">

    <div class="row">
        <?php
        // Lặp qua từng ô trong dòng
        foreach ($table as $key => $value) {
            $id_table = $value["id_table"];
        ?>
            <div class="col-6 col-md-2 mb-3">
                <!-- Nội dung của ô -->
                <div class="grid-item text-center">
                    <a href="?pos=table_bill&id_table=<?php echo $value["id_table"] ?>" style="color: black; text-decoration: none;">
                        <div class="card-table <?php if ($value["status"] == 0)
                                                    echo "bg-light";
                                                else {
                                                    echo "bg-blue";
                                                }
                                                ?>">
                            <div class="card-body">
                                <!-- <h4 class="t-up">Bàn số</h4> -->
                                <center>
                                    <h5 class="card-title"><?php echo $value["name_table"] ?></h5>
                                    <div class="btn btn-secondary btn-choose-order">
                                        <center>
                                            <i class="fa fa-table" style="font-size: 30px;"></i>
                                        </center>
                                    </div>
                                    <b><p class="text-danger" style="font-size: 20px"><?php
                                        $table_total = "SELECT SUM(price) AS total_price
                                                        FROM db_table_detail
                                                        WHERE id_table = '$id_table'";
                                        $result = mysqli_query($conn, $table_total);
                                        $row = mysqli_fetch_assoc($result);
                                        $total_price = $row['total_price'];
                                        if ($total_price == 0) {
                                            echo '';
                                        } else {
                                        echo number_format($total_price);
                                        }
                                        ?></p></b>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

</div>