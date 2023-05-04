<option value="<?= $this->currency["code"] ?>"><?= $this->currency["code"] ?></option>
<?php
    foreach($this->currencies as $k => $v) {
        if ($k != $this->currency["code"]) {
            echo "<option value='" . $k . "'>" . $k . "</option>";
        }
    }
?>