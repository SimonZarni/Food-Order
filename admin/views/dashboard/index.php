<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once __DIR__ . '/../../layouts/sidebar.php';
include_once __DIR__ . '/../../controller/OrderController.php';
include_once __DIR__ . '/../../controller/DeliveryController.php';
include_once __DIR__ . '/../../controller/ItemController.php';
include_once __DIR__ . '/../../controller/RestaurantController.php';
include_once __DIR__ . '/../../controller/MenuController.php';
include_once __DIR__ . '/../../controller/UserController.php';

$order_controller = new OrderController();
$orders = $order_controller->getRecentOrders();
$mostboughtitem = $order_controller->getMostBoughtItem();
$total_orders = $order_controller->getTotalOrders();
$total_accepted_orders = $order_controller->getTotalAcceptedOrders();
$total_declined_orders = $order_controller->getTotalDeclinedOrders();
$total_pending_orders = $order_controller->getTotalPendingOrders();
$delivery_controller = new DeliveryController();
$total_delivery_count = $delivery_controller->getTotalDeliveries();
$total_delivered_count = $delivery_controller->getTotalDeliveredDeliveries();
$total_undelivered_count = $delivery_controller->getTotalUndeliveredDeliveries();
$item_controller = new ItemController();
$totalitem = $item_controller->getTotalItems();
$restaurant_controller = new RestaurantController();
$totalrestaurant = $restaurant_controller->getTotalRestaurants();
$menu_controller = new MenuController();
$totalmenu = $menu_controller->getTotalMenus();
$user_controller = new UserController();
$totaluser = $user_controller->getTotalUsers();

?>

<div class="container-fluid">
  <?php
  if (isset($_GET['reset_status'])) {
    echo "<div class='alert alert-success'>Your password has been reset successfully.</div>";
  } elseif (isset($_GET['change_status'])) {
    echo "<div class='alert alert-success'>Your password has been changed successfully.</div>";
  }
  ?>
  <!--  Row 1 -->
  <div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Welcome Our Food-Order Service</h5>
          <div class="row fs-3">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card border-1 text-white bg-warning o-hidden">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <span class="m-3">Total Items</span>
                            <i class="ti ti-pizza fs-6"></i>
                        </div>
                        <h2 class="text-center text-white mr-5"><?php echo $totalitem?></h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card border-1 text-white bg-primary o-hidden">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <span class="m-1">Total Restaurant</span>
                            <i class="ti ti-location fs-6"></i>
                        </div>
                        <h2 class="text-center text-white mr-5"><?php echo $totalrestaurant?></h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card border-1 text-white bg-success o-hidden">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <span class="m-3">Total Menu</span>
                            <i class="ti ti-cup fs-6"></i>
                        </div>
                        <h2 class="text-center text-white mr-5"><?php echo $totalmenu?></h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card border-1 text-white bg-danger o-hidden">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <span class="m-3">Total User</span>
                            <i class="ti ti-user fs-6"></i>
                        </div>
                        <h2 class="text-center text-white mr-5"><?php echo $totaluser?></h2>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <h5><strong>Most Bought Item:</strong>  <span class=""><?php echo $mostboughtitem['item_name']," from ".$mostboughtitem['restaurant_name']. " restaurant"; ?></span></h5>
                  <h5><strong>Total Orders:</strong>  <span class=""><?php echo $total_orders?></span></h5>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold">Details About Orders</h5><br>
          <!-- Total Orders Section -->
          <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card text-center border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text display-6 text-primary"><?php echo $total_orders; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card border border-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Accepted Orders</h5>
                            <p class="card-text text-success"><?php echo $total_accepted_orders; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Declined Orders</h5>
                            <p class="card-text text-danger"><?php echo $total_declined_orders; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border border-warning">
                        <div class="card-body">
                            <h5 class="card-title">Total Pending Orders</h5>
                            <p class="card-text text-warning"><?php echo $total_pending_orders; ?></p>
                        </div>
                    </div>
                </div>
              </div><br>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold">Details About Delivery</h5><br>
          <!-- Total Orders Section -->
          <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card text-center border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Delivery</h5>
                        <p class="card-text display-6 text-primary"><?php echo $total_delivery_count; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border border-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Delivered Orders</h5>
                            <p class="card-text text-success"><?php echo $total_delivered_count; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Declined Delivery</h5>
                            <p class="card-text text-danger"><?php echo $total_undelivered_count; ?></p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Sales Overview</h5>
            </div>
            <div>
              <select class="form-select">
                <option value="1">March 2023</option>
                <option value="2">April 2023</option>
                <option value="3">May 2023</option>
                <option value="4">June 2023</option>
              </select>
            </div>
          </div>
          <div id="chart"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12">
          <!-- Yearly Breakup -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
              <div class="row align-items-center">
                <div class="col-8">
                  <h4 class="fw-semibold mb-3">$36,358</h4>
                  <div class="d-flex align-items-center mb-3">
                    <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-left text-success"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                    <p class="fs-3 mb-0">last year</p>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="me-4">
                      <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">2023</span>
                    </div>
                    <div>
                      <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">2023</span>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-center">
                    <div id="breakup"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <!-- Monthly Earnings -->
          <div class="card">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                  <h4 class="fw-semibold mb-3">$6,820</h4>
                  <div class="d-flex align-items-center pb-1">
                    <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-down-right text-danger"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                    <p class="fs-3 mb-0">last year</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-currency-dollar fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="earning"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Recent Orders</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">ID</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Order Code</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Total Price</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Order Date</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Customer Name</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Township</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Invoice</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($orders as $order) {
                ?>
                  <tr>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0"><?php echo $order['id']; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1"><?php echo $order['order_code']; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal"><?php echo $order['subtotal']; ?></p>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal"><?php echo $order['order_date']; ?></p>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 fs-4"><?php echo $order['username']; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                      <p class="fw-semibold mb-0 fs-4"><?php echo $order['township']; ?></p>
                    </td>
                    <td class="border-bottom-0">
                      <a href="invoice.php?order_code=<?php echo $order['order_code']; ?>" class="btn btn-primary">Invoice</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
          <a href="javascript:void(0)"><img src="../../src/images/products/s4.jpg" class="card-img-top rounded-0" alt="..."></a>
          <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
        </div>
        <div class="card-body pt-3 p-4">
          <h6 class="fw-semibold fs-4">Boat Headphone</h6>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-semibold fs-4 mb-0">$50 <span class="ms-2 fw-normal text-muted fs-3"><del>$65</del></span></h6>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
          <a href="javascript:void(0)"><img src="../../src/images/products/s5.jpg" class="card-img-top rounded-0" alt="..."></a>
          <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
        </div>
        <div class="card-body pt-3 p-4">
          <h6 class="fw-semibold fs-4">MacBook Air Pro</h6>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-semibold fs-4 mb-0">$650 <span class="ms-2 fw-normal text-muted fs-3"><del>$900</del></span></h6>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
          <a href="javascript:void(0)"><img src="../../src/images/products/s7.jpg" class="card-img-top rounded-0" alt="..."></a>
          <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
        </div>
        <div class="card-body pt-3 p-4">
          <h6 class="fw-semibold fs-4">Red Valvet Dress</h6>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-semibold fs-4 mb-0">$150 <span class="ms-2 fw-normal text-muted fs-3"><del>$200</del></span></h6>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
          <a href="javascript:void(0)"><img src="../../src/images/products/s11.jpg" class="card-img-top rounded-0" alt="..."></a>
          <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
        </div>
        <div class="card-body pt-3 p-4">
          <h6 class="fw-semibold fs-4">Cute Soft Teddybear</h6>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-semibold fs-4 mb-0">$285 <span class="ms-2 fw-normal text-muted fs-3"><del>$345</del></span></h6>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
              <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>

  </html>

  <?php
  include_once __DIR__ . '/../../layouts/footer.php';
  ?>