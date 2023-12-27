<?php

namespace App\Models;

use CodeIgniter\Model;

class DefaultModel extends Model
{
    /**
     * addRow
     * updateRow
     * deleteRow
     * getRows
     * getRowsIn
     * getRowsJoin
     * getRowsSearch
     * getRowsSearchJoin
     * getDistinctRows
     * getRow
     * getRowIn
     * getNextRow
     * getNextRows
     * getPrevRow
     * getPrevRows
     * getFirstRow
     * getLastRow
     * getRowMath
     * getRowJoin
     */

    // addRow
    public function addRow($tbl, $data)
    {
        $builder = $this->db->table($tbl);
        $builder->insert($data);
        return $this->db->insertID();
    }

    // updateRow
    public function updateRow($tbl, $data, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->update($data);
        return true;
    }
    
    // deleteRow
    public function deleteRow($tbl, $where = [], $status = 'delete')
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

    // getRows
    public function getRows($tbl, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->orderBy($orderBy);
        if ($limit && !$offset) $builder->limit($limit);
        if ($limit && $offset) $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsIn
    public function getRowsIn($tbl, $whereInCol, $whereInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->whereIn($whereInCol, $whereInVal);
        $builder->orderBy($orderBy);
        if ($limit && !$offset) $builder->limit($limit);
        if ($limit && $offset) $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsJoin
    public function getRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
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

    // getRowsSearch
    public function getRowsSearch($tbl, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
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

    // getRowsSearchJoin
    public function getRowsSearchJoin($tbl1, $tbl2, $onClause, $select = '*', $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
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

    // getDistinctRows
    public function getDistinctRows($tbl, $distinct_col, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->select($distinct_col);
        $builder->distinct($distinct_col);
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRow
    public function getRow($tbl, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $query = $builder->get();
        return $query->getRow();
    }

    // getRowIn
    public function getRowIn($tbl, $whereInCol, $whereInVal, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->whereIn($whereInCol, $whereInVal);
        $query = $builder->get();
        return $query->getRow();
    }

    // getNextRow
    public function getNextRow($tbl, $current_col_name, $current_col_val, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->where($current_col_name . ' >', $current_col_val);
        $builder->orderBy($current_col_name, 'ASC');
        $query = $builder->get();
        return $query->getRow();
    }

    // getNextRows
    public function getNextRows($tbl, $current_col_name, $current_col_val, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->where($current_col_name . ' >', $current_col_val);
        $builder->orderBy($current_col_name, 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // getPrevRow
    public function getPrevRow($tbl, $current_col_name, $current_col_val, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->where($current_col_name . ' <', $current_col_val);
        $builder->orderBy($current_col_name, 'DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // getPrevRows
    public function getPrevRows($tbl, $current_col_name, $current_col_val, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->where($current_col_name . ' <', $current_col_val);
        $builder->orderBy($current_col_name, 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // getFirstRow
    public function getFirstRow($tbl, $where = [], $orderBy = 'id ASC')
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->orderBy($orderBy);
        $builder->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }

    // getLastRow
    public function getLastRow($tbl, $where = [], $orderBy = 'id DESC')
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        $builder->orderBy($orderBy);
        $builder->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }

    // getRowMath
    public function getRowMath($tbl, $math = 'SUM', $col, $where = [])
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

    // getRowJoin
    public function getRowJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = '')
    {
        $builder = $this->db->table($tbl1);
        $builder->select($select);
        $builder->where($where);
        $builder->orderBy($orderBy);
        $builder->join($tbl2, $onClause);
        $query = $builder->get();
        return $query->getRow();
    }
}
