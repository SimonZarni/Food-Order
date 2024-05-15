<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../model/Order.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/Exception.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/PHPMailer.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/SMTP.php';

class OrderController
{
    private $order;
    function __construct()
    {
        $this->order = new Order();
    }

    public function getOrders()
    {
        return $this->order->getOrders();
    }

    public function filterOrder($order_date)
    {
        return $this->order->filterOrder($order_date);
    }

    public function getOrdersByPrice($min_price, $max_price)
    {
        return $this->order->getOrdersByPrice($min_price, $max_price);
    }

    public function getOrdersByTownship($township)
    {
        return $this->order->getOrdersByTownship($township);
    }

    public function getRecentOrders()
    {
        return $this->order->getRecentOrders();
    }

    public function getOrderByCode($order_code)
    {
        return $this->order->getOrderByCode($order_code);
    }

    public function getOrderCodeById($id)
    {
        return $this->order->getOrderCodeById($id);
    }

    public function getOrderDetails($id) {
        return $this->order->getOrderDetails($id);
    }    


    public function acceptOrder($order_id)
    {
        $accepted = $this->order->acceptOrder($order_id);

        if ($accepted) {
            $orderCodeData = $this->getOrderCodeById($order_id);

            if ($orderCodeData) {
                $order_code = $orderCodeData['order_code'];

                $invoiceDetails = $this->order->getOrderByCode($order_code);

                if ($invoiceDetails) {
                    $email = $this->order->getEmailByOrder($order_id);
                    if ($email) {
                        $message = "Your Order has been accepted. Thank you for your order. Your food will be delivered in a short time.<br>";
                        $message .= "Order Code: " . $invoiceDetails[0]['order_code'] . "<br>";
                        $message .= "Customer Name: " . $invoiceDetails[0]['username'] . "<br>";
                        $message .= "Order Date: " . $invoiceDetails[0]['order_date'] . "<br>";
                        $message .= "Township: " . $invoiceDetails[0]['township'] . "<br>";
                        $message .= "<table border='1'>";
                        $message .= "<tr><th>No</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>";
                        $count = 1;
                        foreach ($invoiceDetails as $item) {
                            $message .= "<tr>";
                            $message .= "<td>" . $count++ . "</td>";
                            $message .= "<td>" . $item['item'] . "</td>";
                            $message .= "<td>" . $item['quantity'] . "</td>";
                            $message .= "<td>" . $item['item_price'] . "</td>";
                            $message .= "<td>" . $item['total_price'] . "</td>";
                            $message .= "</tr>";
                        }
                        $message .= "<tr>";
                        $message .= "<td colspan='4'>Delivery Fee</td>";
                        $message .= "<td colspan='1'>" . $invoiceDetails[0]['fee'] . "</td>";
                        $message .= "</tr>";
                        $message .= "<tr>";
                        $message .= "<td colspan='4'>Total Price</td>";
                        $message .= "<td colspan='1'>" . $invoiceDetails[0]['subtotal'] . "</td>";
                        $message .= "</tr>";
                        $message .= "</table>";
                        return $this->OrderMail($email, $message);
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function declineOrder($order_id)
    {
        $declined = $this->order->declineOrder($order_id);
        if ($declined) {
            $email = $this->order->getEmailByOrder($order_id);
            if ($email) {
                $message = "Your Order has been declined due to some reasons. Please contact us for more information. (foodorder@gmail.com)<br>";
                return $this->OrderMail($email, $message);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function addDelivery($order_code, $user_id, $phone, $address, $order_date, $township_id, $status)
    {
        return $this->order->addDelivery($order_code, $user_id, $phone, $address, $order_date, $township_id, $status);
    }

    public function orderMail($email, $message)
    {
        $mailer = new PHPMailer(true);

        try {
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = 587;

            $mailer->Username = "simonzarni03@gmail.com";
            $mailer->Password = "uszj czrg zowg apxa";

            $mailer->setFrom("simonzarni03@gmail.com", "Food Order");

            if (is_array($email)) {
                $email = implode(',', $email);
            }
            $mailer->addAddress($email);

            $mailer->IsHTML(true);
            $mailer->Subject = "Your order status";
            $mailer->Body = $message;

            if ($mailer->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
            return false;
        }
    }
}
