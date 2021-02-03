<?php

namespace Module\khachhang\Model;

class KhachHangForm extends \PFBC\Form implements IKhachHangForm {

    public $Id;
    public $Code;
    public $Name;
    public $Parents;
    public $KhuVuc;
    public $ThongTinThanhToan;
    public $LoaiHinhKinhDoanh;
    public $DiaChi;
    public $PhuongXa;
    public $QuanHuyen;
    public $TinhThanh;
    public $LaChuKinhDoanh;
    public $DienThoai;
    public $DiDong;
    public $Zalo;
    public $MaSoThue;
    public $DiaChiGiaoHang;
    public $NhomHangKinhDoanh;

    public function __construct($dv = null) {

    }

    private static $Option = ["class" => "form-control"];

    public static function Id($Id = null) {
//        return new \PFBC\Element\Hidden("option[Id]", $Id, []);
        return new \PFBC\Element\Hidden("option[Id]", $Id);
    }

    public static function Name($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Tên Khách Hàng", "option[Name]", $Option);
    }

    public static function Parents($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        $options = KhachHang::GetALL2Options();
        array_unshift($options, "Là Cấp Cha");
        return new \PFBC\Element\Select("Cấp Cha", "option[Parents]", $options, $Option);
    }

    public static function KhuVuc($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        $options = \Module\option\Model\Option::GetAll2OptionsByGroups(\Module\option\Model\Option::KhuVuc);
        return new \PFBC\Element\Select("Khu Vực", "option[Groups]", $options, $Option);
    }

    public static function ThongTinThanhToan($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Thông Tin Thanh Toán", "option[ThongTinThanhToan]", $Option);
    }

    public static function LoaiHinhKinhDoanh($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;

        $options = \Module\option\Model\Option::GetAll2OptionsByGroups(\Module\option\Model\Option::MaNhomKinhDoanh);
        return new \PFBC\Element\Select("Loại Hình Kinh Doanh", "option[Groups]", $options, $Option);
    }

    public static function DiaChi($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Địa Chỉ", "option[DiaChi]", $Option);
    }

    public static function TinhThanh($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Tỉnh Thành", "option[TinhThanh]", $Option);
    }

    public static function LaChuKinhDoanh($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $options[0] = "Không";
        $options[1] = "Có";
        return new \PFBC\Element\Select("Là Chủ Kinh Doanh", "option[LaChuKinhDoanh]", $options, $Option);
    }

    public static function btnSubmit() {
        return new \PFBC\Element\Button("Lưu", "submit", ["class" => "btn-succes", "Name" => "OnSave"]);
    }

    public static function btnXoa($options) {
        $link = <<<Link
                <a href="/khachhang/index/delete/{$options}" data-confirm="Bạn Muốn Xóa Khách Hàng Này?" class="btn xoa btn-danger" >Xóa</a>
Link;
        echo $link;
    }

    public static function btnThem($btnThem = 'Thêm') {
        $link = <<<Link
                <a href="/khachhang/index/add/" class="btn btn-success" >{$btnThem}</a>
Link;
        echo $link;
    }

    public static function btnEdit($options) {
        $link = <<<Link
                <a href="/khachhang/index/edit/{$options}" class="btn btn-primary" >Sửa</a>
Link;
        echo $link;
    }

    public static function Code($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["ng-model"] = "MaKhachHang";
        return new \PFBC\Element\Textbox("Mã Khách Hàng (aaabbb-ccdddd)", "option[Code]", $Option);
    }

    public static function DiDong($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("Di Động", "option[DiDong]", $Option);
    }

    public static function DiaChiGiaoHang($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("Địa Chỉ Giao Hàng", "option[DiaChiGiaoHang]", $Option);
    }

    public static function DienThoai($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("Điện Thoại", "option[DienThoai]", $Option);
    }

    public static function MaSoThue($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("Mã Số Thuế", "option[MaSoThue]", $Option);
    }

    public static function NhomHangKinhDoanh($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("Nhóm Hàng Kinh Doanh", "option[NhomHangKinhDoanh]", $Option);
    }

    public static function PhuongXa($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("Phường Xã", "option[PhuongXa]", $Option);
    }

    public static function QuanHuyen($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("Quận Huyện", "option[QuanHuyen]", $Option);
    }

    public static function Zalo($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        return new \PFBC\Element\Textbox("ZaLo", "option[Zalo]", $Option);
    }

}
?>
