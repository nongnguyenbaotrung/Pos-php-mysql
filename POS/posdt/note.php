Thêm menu dropdown (select) để chọn tên khách hàng
            <div class="row">
                <div class="col-md-6">
                    <label for="customerSelect">Chọn khách hàng:</label>
                    <select id="customerSelect" class="form-control">
                        <option value="">-- Chọn khách hàng --</option>
                        <option value="Khách hàng A">Khách hàng A</option>
                        <option value="Khách hàng B">Khách hàng B</option>
                        <option value="Khách hàng C">Khách hàng C</option>
                        <!-- Thêm các tên khách hàng khác vào đây -->
                    </select>
                </div>
                <!-- <div class="col-md-6 mt-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProduct">
                        <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm sản phẩm mới
                    </button>
                </div> -->
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" onclick="selectCustomer()">Chọn khách hàng</button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm khách hàng mới
                </button>
                <form action="#" method="post">
                    <!-- <input class="btn btn-danger" type="submit" value="Reset khách hàng"> -->
                    <button class="btn btn-danger" onclick="">Reset khách hàng</button>
                </form>
            </div>
            <!-- Phần giảm giá -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="">
                        <label for="discountType">Loại giảm giá:</label>
                        <select id="discountType" class="form-control" onchange="calculateTotalAmount()">
                            <option value="percent">Giảm theo %</option>
                            <option value="amount">Giảm theo giá tiền</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discountValue">Số tiền giảm giá:</label>
                        <input type="number" id="discountValue" class="form-control" placeholder="Nhập số tiền giảm giá" onchange="calculateTotalAmount()">
                    </div>
                </div>
            </div>
            <p>Tổng đơn: <b id="totalAmount">0 </b>VND</p>
            <p>Số tiền giảm: <b id="discountAmount">0 </b>VND</p>
            <p>Tổng tiền sau giảm: <b id="totalAfterDiscount">0 </b>VND</p>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" onclick="checkout()">Thanh toán</button>
                <button class="btn btn-secondary ml-2" onclick="printBill()">In hoá đơn</button>
                <button class="btn btn-danger" onclick="clearBill()">Xoá toàn bộ</button>
            </div>