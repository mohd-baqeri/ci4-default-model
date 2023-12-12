<?php

namespace App\Models;

use CodeIgniter\Model;

class DefaultModel extends Model
{
    /**
     * addTblRow
     * updateTblRow
     * getTblRows
     * getTblRowsJoin
     * searchTblRows
     * searchTblRowsJoin
     * getTblRow
     * getTblRowNext
     * getTblRowPrev
     * getTblRowFirst
     * getTblRowLast
     * getTblRowMath
     * getTblRowJoin
     * deleteTblRow
     * getTblRowsDistinct
     */

    // addTblRow
    public function addTblRow($tbl, $data)
    {
        $builder = $this->db->table($tbl);
        $builder->insert($data);
        return $this->db->insertID();
    }

    // updateTblRow
    public function updateTblRow($tbl, $data, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    // getTblRows
    public function getTblRows($tbl, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->orderBy($orderBy);
        if ($limit && !$offset) $builder->limit($limit);
        if ($limit && $offset) $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getTblRowsJoin
    public function getTblRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl1);
        $builder->select($select);
        $builder->where($where);
        $builder->orderBy($orderBy);
        $builder->join($tbl2, $onClause);
        if ($limit && !$offset) $builder->limit($limit);
        if ($limit && $offset) $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // searchTblRows
    public function searchTblRows($tbl, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->like($like);
        $builder->where($where);
        $builder->orderBy($orderBy);
        if ($limit && !$offset) $builder->limit($limit);
        if ($limit && $offset) $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // searchTblRowsJoin
    public function searchTblRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl1);
        $builder->select($select);
        $builder->where($where);
        $builder->like($like);
        $builder->orderBy($orderBy);
        $builder->join($tbl2, $onClause);
        if ($limit && !$offset) $builder->limit($limit);
        if ($limit && $offset) $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getTblRow
    public function getTblRow($tbl, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $query = $builder->get();
        return $query->getRow();
    }

    // getTblRowNext
    public function getTblRowNext($tbl, $current_col_name, $current_col_val, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->where($current_col_name . ' >', $current_col_val);
        $builder->orderBy($current_col_name, 'ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // getTblRowPrev
    public function getTblRowPrev($tbl, $current_col_name, $current_col_val, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->where($current_col_name . ' <', $current_col_val);
        $builder->orderBy($current_col_name, 'DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // getTblRowFirst
    public function getTblRowFirst($tbl, $where = [], $orderBy = 'id ASC')
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->orderBy($orderBy);
        $builder->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }

    // getTblRowLast
    public function getTblRowLast($tbl, $where = [], $orderBy = 'id DESC')
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->orderBy($orderBy);
        $builder->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }

    // getTblRowMath
    public function getTblRowMath($tbl, $math = 'SUM', $col, $where = [])
    {
        $builder = $this->db->table($tbl);
        if ($math == 'AVG') $builder->selectAvg($col, 'avg_' . $col);
        if ($math == 'COUNT') $builder->selectCount($col, 'count_' . $col);
        if ($math == 'MAX') $builder->selectMax($col, 'max_' . $col);
        if ($math == 'MIN') $builder->selectMin($col, 'min_' . $col);
        if ($math == 'SUM') $builder->selectSum($col, 'sum_' . $col);
        $builder->where($where);
        $query = $builder->get();
        return $query->getRow();
    }

    // getTblRowJoin
    public function getTblRowJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = '')
    {
        $builder = $this->db->table($tbl1);
        $builder->select($select);
        $builder->where($where);
        $builder->orderBy($orderBy);
        $builder->join($tbl2, $onClause);
        $query = $builder->get();
        return $query->getRow();
    }

    // deleteTblRow
    public function deleteTblRow($tbl, $where = [], $status = 'delete')
    {
        // update the updated_at COLLUMN for specifying the 'delete time'
        if ($status == 'update') {
            $builder = $this->db->table($tbl);
            $builder->where($where);
            $builder->update([
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return 'updated';
        }

        // move the row to another table,
        if ($status == 'move') {
            $builder = $this->db->table($tbl)->where($where);
            $selectQuery = $builder->getCompiledSelect();
            $this->db->query("INSERT INTO " . $tbl . "_deleted " . $selectQuery);
            return $this->db->insertID();
        }

        // and then delete it
        if ($status == 'delete') {
            $builder = $this->db->table($tbl);
            $builder->where($where);
            $builder->delete();
            return 'deleted';
        }
    }

    // getTblRowsDistinct
    public function getTblRowsDistinct($tbl, $col = false, $where = [])
    {
        $whereClause = '';
        $x = 0;
        foreach ($where as $whereKey => $whereVal) {
            if (strchr($whereKey, ' ')) {
                $exploded = explode(' ', $whereKey);
                $whereClause .= "`" . $exploded[0] . "`$exploded[1]'$whereVal'";
            } else {
                $whereClause .= "`" . $whereKey . "`='$whereVal'";
            }
            if ($x < count($where) - 1) {
                $whereClause .= ' AND ';
            }
            $x++;
        }
        $query = ($col) ? (
            ($whereClause) ? $this->db->query("SELECT DISTINCT `" . $col . "` FROM `$tbl` WHERE " . $whereClause)
                        : $this->db->query("SELECT DISTINCT `" . $col . "` FROM `$tbl`")
        ) : (
            ($whereClause) ? $this->db->query("SELECT DISTINCT * FROM `$tbl` WHERE " . $whereClause)
                        : $this->db->query("SELECT DISTINCT * FROM `$tbl`")
        );
        return $query->getResult();
    }
}
