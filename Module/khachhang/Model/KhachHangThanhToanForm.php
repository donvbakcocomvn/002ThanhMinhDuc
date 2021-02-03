<?php

namespace Module\khachhang\Model;

class KhachHangThanhToanForm extends \PFBC\Form implements IKhachHangThanhToanForm {

    public $Id, $Name, $MaKhachHang, $TenCongTy, $MaSoThue, $DiaChi, $STK, $NganHang, $Fax, $GhiChu;

    public function __construct($dv = null) {

    }

    private static $Option = ["class" => "form-control"];

    public static function Id($Id = null) {
//        return new \PFBC\Element\Hidden("option[Id]", $Id, []);
        return new \PFBC\Element\Hidden("option[Id]", $Id);
    }

    public static function btnSubmit() {
        return new \PFBC\Element\Button("Lưu", "submit", ["class" => "btn-succes", "Name" => "OnSave"]);
    }

    public static function DiaChi($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Địa Chỉ", "option[DiaChi]", $Option);
    }

    public static function Fax($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Fax", "option[Fax]", $Option);
    }

    public static function GhiChu($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Ghi Chú", "option[GhiChu]", $Option);
    }

    public static function MaKhachHang($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        $Option["ng-model"] = "MaKhachHang";
        return new \PFBC\Element\Textbox("Mã Khách Hàng", "option[MaKhachHang]", $Option);
    }

    public static function MaSoThue($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Mã Số Thuế", "option[MaSoThue]", $Option);
    }

    public static function Name($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Tên Công Ty", "option[Name]", $Option);
    }

    public static function NganHang($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        $Options = \Module\option\Model\Option::GetAll2OptionsByGroups(\Module\option\Model\Option::NganHang);
        return new \PFBC\Element\Select("Ngân Hàng", "option[NganHang]", $Options, $Option);
    }

    public static function STK($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Số Tài Khoản", "option[STK]", $Option);
    }

    public static function TenCongTy($value = null) {
        $Option = self::$Option;
        $Option["value"] = $value;
        $Option["required"] = true;
        return new \PFBC\Element\Textbox("Tên Công Ty", "option[TenCongTy]", $Option);
    }

}
?>
