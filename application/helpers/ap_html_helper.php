<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
function Fget_menu_html11($str_niduser)
{
    $html_menu_return = '';
    $html_menu_item   = '';
    $li_tag           = 0;
    $level_tag        = 0;
    $cid_index_01     = '';
    $cfunction        = '';
    $cicon_name       = '';
    $cmenu_01         = '';
    $nid_01           = 0;
    $nid_parent_01    = 0;
    $str_id_list      = '';
    $html_menu_return = '<li>';
    $html_menu_return .= '<a href="#"> Hệ thống </a>';
    $html_menu_return .= '<ul>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="#"> DM hệ thống </a>';
    $html_menu_return .= '<ul>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="' . base_url() . 'index.php/do_department_listview"> DM. Cơ cấu tổ chức </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="' . base_url() . 'index.php/do_employee_listview"> DM. nhân viên </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="' . base_url() . 'index.php/do_position_listview"> DM. Chức vụ </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="' . base_url() . 'index.php/do_department_group_listview"> DM. Kênh báo cáo </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '</ul>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="#"> Phân quyền </a>';
    $html_menu_return .= '<ul>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="' . base_url() . 'index.php/do_menu_permission"> Phân quyền menu chức năng </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="' . base_url() . 'index.php/do_department_permission"> Phân nhóm tài khoản theo đơn vị </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '</ul>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="' . base_url() . 'index.php/do_change_password"> Đổi mật khẩu </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '</ul>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '</ul>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="#"> Trợ giúp </a>';
    $html_menu_return .= '<ul>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="#"> Hướng dẫn sử dụng </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="#"> Hỏi đáp - Góp ý </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '<li>';
    $html_menu_return .= '<a href="#"> Sơ đồ chức năng </a>';
    $html_menu_return .= '</li>';
    $html_menu_return .= '</ul>';
    $html_menu_return .= '</li>';
    return $html_menu_return;
}
function Fgen_html_combobox($str_filter = 0, $str_name, $str_value = ' ', $str_style = '', $obj_data, $field_value, $field_option, $submit_mode = '', $tabindex = '')
{
    $str_return          = '';
    $str_select_tag      = '';
    $str_selected_option = '<option selected="selected"  value="' . $str_value . '">';
    if (trim($str_style) == '') {
        $str_select_tag = '<select style="width:98%" ';
    } else {
        $str_select_tag = '<select style ="' . $str_style . '"';
    }
    if (trim($tabindex) != '') {
        $str_select_tag = $str_select_tag . ' tabindex="' . $tabindex . '" ';
    }
    if (trim($submit_mode) == 'submit') {
        $str_select_tag = $str_select_tag . ' onChange="this.form.submit();" ';
    }
    $str_return = $str_select_tag . ' name = ' . $str_name . '>';
    if (trim($str_filter) == '') {
        $str_return = $str_return . ' <option value=""> ' . ' ' . '</option>';
    }
    foreach ($obj_data as $data) {
        if (trim($str_value) == $data[$field_value]) {
            $str_return = $str_return . $str_selected_option . $data[$field_option] . '</option>';
        } else {
            $str_return = $str_return . '<option value=' . $data[$field_value] . '>' . $data[$field_option] . '</option>';
        }
    }
    $str_return = $str_return . '</select>';
    return $str_return;
}
function Fgen_combo($obj_data, $str_value_field_name, $str_index_field_name, $str_filter = 0, $str_name, $str_value = '0', $str_style = '', $tabindex = '', $submit_mode = '')
{
    $str_return          = '';
    $str_select_tag      = '';
    $str_selected_option = '<option selected="selected" value="' . $str_value . '">';
    if (trim($str_style) == '') {
        $str_select_tag = '<select style="width:98%" ';
    } else {
        $str_select_tag = '<select ';
    }
    if (trim($submit_mode) == 'submit') {
        $str_select_tag = $str_select_tag . ' onChange="this.form.submit();" ';
    }
    if (trim($tabindex) != '') {
        $str_select_tag = $str_select_tag . ' tabindex="' . $tabindex . '" ';
    }
    $str_return = $str_select_tag . 'name = ' . $str_name . '>';
    if (trim($str_filter) == '0') {
        $str_return = $str_return . '<option value="">' . ' ' . '</option>';
    }
    foreach ($obj_data as $data) {
        if (trim($str_value) == $data[$str_index_field_name]) {
            $str_return = $str_return . $str_selected_option . $data[$str_value_field_name] . '</option>';
        } else {
            $str_return = $str_return . '<option value=' . $data[$str_index_field_name] . '>' . $data[$str_value_field_name] . '</option>';
        }
    }
    $str_return = $str_return . '</select>';
    return $str_return;
}
function Fget_menu_html($nid_user)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    $html_menu_return = '';
    $html_menu_item   = '';
    $li_tag           = 0;
    $level_tag        = 0;
    $cid_index_01     = '';
    $cfunction        = '';
    $cicon_name       = '';
    $cmenu_01         = '';
    $nid_01           = 0;
    $nid_parent_01    = 0;
    $isadmin          = Fget_userdata('session_user_isadmin');
    if (trim($isadmin) != '3') {
        $str_id_list = '';
        $obj_helper->db->where('cbasic', '1');
        $obj_result = $obj_helper->db->get(Fget_tkb_table('tmenu'));
        $obj_result = $obj_result->result_array();
        foreach ($obj_result as $obj_row)
            $str_id_list .= $obj_row['nid'] . ',';
        $obj_helper->db->where('nid_user', $nid_user);
        $obj_result = $obj_helper->db->get(Fget_tkb_table('tuser_menu'));
        $obj_result = $obj_result->result_array();
        foreach ($obj_result as $obj_row)
            $str_id_list .= $obj_row['nid_menu'] . ',';
        $str_id_list = substr($str_id_list, 0, strlen(trim($str_id_list)) - 1);
        $sql_string  = ' SELECT a.*, b.cfunction ';
        $sql_string .= ' FROM  ';
        $sql_string .= ' ' . Fget_tkb_table('tmenu') . ' as a  ,';
        $sql_string .= ' ' . Fget_tkb_table('tfunction') . ' as b  ';
        $sql_string .= ' WHERE  a.cdel=0 ';
        $sql_string .= ' AND a.nid_function = b.nid  ';
        $sql_string .= ' AND a.nid in (' . $str_id_list . ') order by a.cindex  ';
    } else {
        $sql_string = ' SELECT a.*, b.cfunction ';
        $sql_string .= ' FROM  ';
        $sql_string .= ' ' . Fget_tkb_table('tmenu') . ' as a  ,';
        $sql_string .= ' ' . Fget_tkb_table('tfunction') . ' as b  ';
        $sql_string .= ' WHERE a.cdel=0 ';
        $sql_string .= ' AND a.nid_function = b.nid  order by a.cindex ';
    }
    $menu_root = $obj_helper->db->query($sql_string);
    if ($menu_root->num_rows() > 0) {
        foreach ($menu_root->result() as $row) {
            $cid_index_01   = $row->cindex;
            $cmenu_01       = $row->cmenu;
            $nid_01         = $row->nid;
            $cnode          = $row->cnode;
            $cicon_name     = $row->cicon_name;
            $nid_parent_01  = $row->nid_parent;
            $level_tag      = strlen($cid_index_01) / 5;
            $cfunction      = $row->cfunction;
            $cmenu_01_lable = $obj_helper->lang->line($cmenu_01);
            if (trim($cmenu_01) != '')
                if (trim($cmenu_01_lable) == '')
                    $cmenu_01_lable = $cmenu_01;
            if (trim($cfunction) != '')
                $cfunction = site_url() . '/' . $cfunction;
            else
                $cfunction = '#';
            if ($cmenu_01 == '')
                $html_menu_item = ' <li class="separator"> <span> </span> ';
            else {
                if ($level_tag == 1) {
                    $html_menu_item = ' <li> ';
                    $html_menu_item = $html_menu_item . ' <a href="' . $cfunction . ' "> ' . $cmenu_01_lable . ' </a> ';
                } else {
                    if ($cnode != '0') {
                        $html_menu_item = ' <li> <a ' . $cicon_name . ' href="' . $cfunction . ' "> ' . $cmenu_01_lable . '</a>';
                    } else {
                        $html_menu_item = ' <li class="node"> <a ' . $cicon_name . ' href="' . $cfunction . ' "> ' . $cmenu_01_lable . '</a>';
                    }
                }
            }
            if ($li_tag == 0) {
                ++$li_tag;
                $html_menu_return = $html_menu_return . $html_menu_item;
            } else {
                if ($level_tag == $li_tag) {
                    $html_menu_return = $html_menu_return . ' </li> ';
                    $html_menu_return = $html_menu_return . $html_menu_item;
                } else {
                    if ($level_tag > $li_tag) {
                        ++$li_tag;
                        $html_menu_return = $html_menu_return . '  <ul>';
                        $html_menu_return = $html_menu_return . $html_menu_item;
                    } else {
                        $html_menu_return = $html_menu_return . ' </li> ';
                        while ($li_tag > $level_tag) {
                            $html_menu_return = $html_menu_return . ' </ul> </li> ';
                            $li_tag--;
                        }
                        $html_menu_return = $html_menu_return . $html_menu_item;
                    }
                }
            }
        }
    }
    $html_menu_return = $html_menu_return . ' </li> ';
    while ($li_tag > 1) {
        $html_menu_return = $html_menu_return . ' </ul> </li> ';
        $li_tag--;
    }
    return $html_menu_return;
}
function Fpaging($total_row, $current, $row_per_page, $ctr_name, $ancho)
{
    $npage      = $total_row;
    $str_paging = '';
    if ($npage > 0) {
        $npage = intval($total_row / $row_per_page);
        if ($total_row % $row_per_page > 0)
            $npage += 1;
        if ($npage > 1) {
            for ($i = 1; $i <= $npage; $i++) {
                if ($i == $current)
                    $str_paging .= '<a class="active pagination" href = "' . base_url() . $ctr_name . '/page/' . $i . '">' . $i;
                else
                    $str_paging .= '<a  class="pagination" href = "' . base_url() . $ctr_name . '/page/' . $i . '">' . $i;
                $str_paging .= '</a>';
            }
        }
        return $str_paging;
    }
}
function Fpaging_news($total_row, $current, $row_per_page, $ctr_name, $nid_sec = '', $nid_cat = '')
{
    $npage      = $total_row;
    $str_paging = '';
    if ($npage > 0) {
        $npage = intval($total_row / $row_per_page);
        if ($total_row % $row_per_page > 0)
            $npage += 1;
        if ($npage > 1) {
            if ($nid_cat == ''):
                for ($i = 1; $i <= $npage; $i++) {
                    if ($i == $current)
                        $str_paging .= '<a class="active pagination" href = "' . base_url() . $ctr_name . '/page/' . $i . '/' . $nid_sec . '">' . $i;
                    else
                        $str_paging .= '<a  class="pagination" href = "' . base_url() . $ctr_name . '/page/' . $i . '/' . $nid_sec . '">' . $i;
                    $str_paging .= '</a>';
                }
            else:
                for ($i = 1; $i <= $npage; $i++) {
                    if ($i == $current)
                        $str_paging .= '<a class="active pagination" href = "' . base_url() . $ctr_name . '/page/' . $i . '/' . $nid_sec . '/' . $nid_cat . '/' . '">' . $i;
                    else
                        $str_paging .= '<a  class="pagination" href = "' . base_url() . $ctr_name . '/page/' . $i . '/' . $nid_sec . '/' . $nid_cat . '/' . '">' . $i;
                    $str_paging .= '</a>';
                }
            endif;
        }
        return $str_paging;
    }
}
function Hpaging($total_row, $current, $row_per_page, $ctr_name, $ancho)
{
    $npage      = $total_row;
    $str_paging = '';
    if ($npage > 0) {
        $npage = intval($total_row / $row_per_page);
        if ($total_row % $row_per_page > 0)
            $npage += 1;
        if ($npage > 1) {
            for ($i = 1; $i <= $npage; $i++) {
                if ($i == $current)
                    $str_paging .= '<a class="active pagination" href = "' . base_url() . 'index.php/' . $ctr_name . '/' . $i . $ancho . '">' . $i;
                else
                    $str_paging .= '<a class="pagination" href = "' . base_url() . 'index.php/' . $ctr_name . '/' . $i . $ancho . '">' . $i;
                $str_paging .= '</a>';
            }
        }
        return $str_paging;
    }
}
function Fgen_html_combobox_disable($str_filter = 0, $str_name, $str_value = ' ', $str_style = '', $obj_data, $field_value, $field_option, $submit_mode = '', $tabindex = '', $event)
{
    $str_return     = '';
    $str_select_tag = '';
    $disable        = '';
    if ($event == 'edit' || $event == 'update_edit' || $event == 'edit_trans' || $event == 'update_edit_trans')
        $disable = 'disabled="disabled"';
    $str_selected_option = '<option selected="selected"  value="' . $str_value . '">';
    if (trim($str_style) == '') {
        $str_select_tag = '<select style="width:98%" ' . $disable;
    } else {
        $str_select_tag = '<select  ' . $disable;
    }
    if (trim($tabindex) != '') {
        $str_select_tag = $str_select_tag . ' tabindex="' . $tabindex . '" ';
    }
    if (trim($submit_mode) == 'submit') {
        $str_select_tag = $str_select_tag . ' onChange="this.form.submit();" ';
    }
    $str_return = $str_select_tag . ' name = ' . $str_name . '>';
    if (trim($str_filter) == '') {
        $str_return = $str_return . ' <option value=""> ' . ' ' . '</option>';
    }
    foreach ($obj_data as $data) {
        if (trim($str_value) == $data[$field_value]) {
            $str_return = $str_return . $str_selected_option . $data[$field_option] . '</option>';
        } else {
            $str_return = $str_return . '<option value=' . $data[$field_value] . '>' . $data[$field_option] . '</option>';
        }
    }
    $str_return = $str_return . '</select>';
    return $str_return;
}
function Fgen_pagination($current_page, $total_page, $link_page, $param = '')
{
    $str = '';
    if ($total_page > 1) {
        $str .= '<div id="pagination">';
        if ($current_page > 1):
            $str .= '<a href="' . $link_page . '1' . $param . '">';
        endif;
        $str .= '<< Start';
        if ($current_page > 1):
            $str .= '</a>';
        endif;
        if ($current_page > 1):
            $current_page_pre = $current_page - 1;
            $str .= '<a href="' . $link_page . $current_page_pre . $param . '">';
        endif;
        $str .= '<< Prev';
        if ($current_page > 1):
            $str .= '</a>';
        endif;
        for ($i = 1; $i <= $total_page; $i++) {
            if ($current_page == $i)
                $str .= '<a href="' . $link_page . $i . $param . '" class="active">' . $i . '</a>';
            else
                $str .= '<a href="' . $link_page . $i . $param . '">' . $i . '</a>';
        }
        if ($current_page < $total_page):
            $current_page_next = $current_page + 1;
            $str .= '<a href="' . $link_page . $current_page_next . $param . '">';
        endif;
        $str .= 'Next >';
        if ($current_page < $total_page):
            $str .= '</a>';
        endif;
        if ($current_page < $total_page):
            $str .= '<a href="' . $link_page . $total_page . $param . '">';
        endif;
        $str .= 'End >>';
        if ($current_page < $total_page):
            $str .= '</a>';
        endif;
        $str .= '</div><br/>';
        $str .= '<div style="text-align:center;">Page ' . $current_page . ' of ' . $total_page . '</div>';
    }
    return $str;
}
function Fgen_pagination2($current_page, $total_page, $link_page, $param = '')
{
    $str = '';
    if ($total_page > 1) {
        $str .= '<div id="pagination">';
        if ($current_page > 1):
            $str .= '<a href="' . $link_page . $param . '1">';
        endif;
        $str .= '<< Start';
        if ($current_page > 1):
            $str .= '</a>';
        endif;
        if ($current_page > 1):
            $current_page_pre = $current_page - 1;
            $str .= '<a href="' . $link_page . $param . $current_page_pre . '">';
        endif;
        $str .= '<< Prev';
        if ($current_page > 1):
            $str .= '</a>';
        endif;
        for ($i = 1; $i <= $total_page; $i++) {
            if ($current_page == $i)
                $str .= '<a href="' . $link_page . $param . $i . '" class="active">' . $i . '</a>';
            else
                $str .= '<a href="' . $link_page . $param . $i . '">' . $i . '</a>';
        }
        if ($current_page < $total_page):
            $current_page_next = $current_page + 1;
            $str .= '<a href="' . $link_page . $param . $current_page_next . '">';
        endif;
        $str .= 'Next >';
        if ($current_page < $total_page):
            $str .= '</a>';
        endif;
        if ($current_page < $total_page):
            $str .= '<a href="' . $link_page . $param . $total_page . '">';
        endif;
        $str .= 'End >>';
        if ($current_page < $total_page):
            $str .= '</a>';
        endif;
        $str .= '</div><br/>';
        $str .= '<div style="text-align:center;">Page ' . $current_page . ' of ' . $total_page . '</div>';
    }
    return $str;
}
