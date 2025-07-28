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
     * getRowsInJoin
     * getRowsInSearch
     * getRowsNotIn
     * getRowsNotInSearch
     * getRowsJoin
     * getRowsSearch
     * getRowSearch
     * getRowsSearchJoin
     * getDistinctRows
     * getDistinctRowsSearch
     * getRow
     * getRowIn
     * getRowNotIn 
     * getNextRow
     * getNextRows
     * getPrevRow
     * getPrevRows
     * getFirstRow
     * getLastRow
     * getRowMath
     * getRowMathSearch
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

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get($limit, $offset);

        return $query->getResult();
    }

    // getRowsIn
    public function getRowsIn($tbl, $whereInCol, $whereInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);

        is_array($whereInVal)
            ? $builder->whereIn($whereInCol, $whereInVal)
            : $builder->whereIn($whereInCol, [$whereInVal]);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsInJoin
    public function getRowsInJoin($tbl1, $tbl2, $onClause, $select = '*', $whereInCol, $whereInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false): array
    {
        $builder = $this->db->table($tbl1);
        $builder->select($select);
        $builder->where($where);

        is_array($whereInVal)
            ? $builder->whereIn($whereInCol, $whereInVal)
            : $builder->whereIn($whereInCol, [$whereInVal]);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        $builder->join($tbl2, $onClause);

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsInSearch
    public function getRowsInSearch($tbl, $whereInCol, $whereInVal, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->like($like);
        $builder->where($where);

        is_array($whereInVal)
            ? $builder->whereIn($whereInCol, $whereInVal)
            : $builder->whereIn($whereInCol, [$whereInVal]);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsNotIn
    public function getRowsNotIn($tbl, $whereNotInCol, $whereNotInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);

        is_array($whereNotInVal)
            ? $builder->whereNotIn($whereNotInCol, $whereNotInVal)
            : $builder->whereNotIn($whereNotInCol, [$whereNotInVal]);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsNotInSearch
    public function getRowsNotInSearch($tbl, $whereNotInCol, $whereNotInVal, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->like($like);
        $builder->where($where);

        is_array($whereNotInVal)
            ? $builder->whereNotIn($whereNotInCol, $whereNotInVal)
            : $builder->whereNotIn($whereNotInCol, [$whereNotInVal]);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsJoin
    public function getRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl1);
        $builder->select($select);
        $builder->where($where);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        $builder->join($tbl2, $onClause);
        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowsSearch
    public function getRowsSearch($tbl, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->like($like);
        $builder->where($where);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRowSearch
    public function getRowSearch($tbl, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->like($like);
        $builder->where($where);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getRow();
    }

    // getRowsSearchJoin
    public function getRowsSearchJoin($tbl1, $tbl2, $onClause, $select = '*', $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl1);
        $builder->select($select);
        $builder->where($where);
        $builder->like($like);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        $builder->join($tbl2, $onClause);
        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getDistinctRows
    public function getDistinctRows($tbl, $distinct_col, $where = [], $orderBy = NULL, $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->select($distinct_col);
        $builder->distinct($distinct_col);
        $builder->where($where);

        if ($orderBy) {
            if (is_array($orderBy)) {
                foreach ($orderBy as $orderByItem) {
                    $builder->orderBy($orderByItem);
                }
            } else {
                $builder->orderBy($orderBy);
            }
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getDistinctRowsSearch
    public function getDistinctRowsSearch($tbl, $distinct_col, $like = [], $where = [], $orderBy = NULL, $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->select($distinct_col);
        $builder->distinct($distinct_col);
        $builder->like($like);
        $builder->where($where);

        if ($orderBy) {
            if (is_array($orderBy)) {
                foreach ($orderBy as $orderByItem) {
                    $builder->orderBy($orderByItem);
                }
            } else {
                $builder->orderBy($orderBy);
            }
        }

        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getRow
    public function getRow($tbl, $where = [], $orderBy = NULL)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);

        if ($orderBy) {
            if (is_array($orderBy)) {
                foreach ($orderBy as $orderByItem) {
                    $builder->orderBy($orderByItem);
                }
            } else {
                $builder->orderBy($orderBy);
            }
        }

        $query = $builder->get();
        return $query->getRow();
    }

    // getRowIn
    public function getRowIn($tbl, $whereInCol, $whereInVal, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);

        is_array($whereInVal)
            ? $builder->whereIn($whereInCol, $whereInVal)
            : $builder->whereIn($whereInCol, [$whereInVal]);

        $query = $builder->get();
        return $query->getRow();
    }

    // getRowNotIn
    public function getRowNotIn($tbl, $whereNotInCol, $whereNotInVal, $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);

        is_array($whereNotInVal)
            ? $builder->whereNotIn($whereNotInCol, $whereNotInVal)
            : $builder->whereNotIn($whereNotInCol, [$whereNotInVal]);

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
    public function getNextRows($tbl, $current_col_name, $current_col_val, $where = [], $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        if (strpos($current_col_name, ' ')) {
            $current_col_name_arr = explode(' ', $current_col_name);
            $builder->where($current_col_name_arr[0] . ' ' . $current_col_name_arr[1], $current_col_val);
            $builder->orderBy($current_col_name_arr[0], 'ASC');
        } else {
            $builder->where($current_col_name . ' >', $current_col_val);
            $builder->orderBy($current_col_name, 'ASC');
        }
        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
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
    public function getPrevRows($tbl, $current_col_name, $current_col_val, $where = [], $limit = false, $offset = false)
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);
        if (strpos($current_col_name, ' ')) {
            $current_col_name_arr = explode(' ', $current_col_name);
            $builder->where($current_col_name_arr[0] . ' ' . $current_col_name_arr[1], $current_col_val);
            $builder->orderBy($current_col_name_arr[0], 'DESC');
        } else {
            $builder->where($current_col_name . ' <=', $current_col_val);
            $builder->orderBy($current_col_name, 'DESC');
        }
        if ($limit && !$offset)
            $builder->limit($limit);
        if ($limit && $offset)
            $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    // getFirstRow
    public function getFirstRow($tbl, $where = [], $orderBy = 'id ASC')
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        $builder->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }

    // getLastRow
    public function getLastRow($tbl, $where = [], $orderBy = 'id DESC')
    {
        $builder = $this->db->table($tbl);
        $builder->where($where);

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        $builder->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }

    // getRowMath
    public function getRowMath($tbl, $math = 'SUM', $col = 'id', $where = [])
    {
        $builder = $this->db->table($tbl);
        if ($math == 'AVG')
            $builder->selectAvg($col, 'avg_' . $col);
        if ($math == 'COUNT')
            $builder->selectCount($col, 'count_' . $col);
        if ($math == 'MAX')
            $builder->selectMax($col, 'max_' . $col);
        if ($math == 'MIN')
            $builder->selectMin($col, 'min_' . $col);
        if ($math == 'SUM')
            $builder->selectSum($col, 'sum_' . $col);
        $builder->where($where);
        $query = $builder->get();
        return $query->getRow();
    }

    // getRowMathSearch
    public function getRowMathSearch($tbl, $math = 'SUM', $col = 'id', $like = [], $where = [])
    {
        $builder = $this->db->table($tbl);
        $builder->like($like);
        if ($math == 'AVG')
            $builder->selectAvg($col, 'avg_' . $col);
        if ($math == 'COUNT')
            $builder->selectCount($col, 'count_' . $col);
        if ($math == 'MAX')
            $builder->selectMax($col, 'max_' . $col);
        if ($math == 'MIN')
            $builder->selectMin($col, 'min_' . $col);
        if ($math == 'SUM')
            $builder->selectSum($col, 'sum_' . $col);
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

        if (is_array($orderBy)) {
            foreach ($orderBy as $orderByItem) {
                $builder->orderBy($orderByItem);
            }
        } else {
            $builder->orderBy($orderBy);
        }

        $builder->join($tbl2, $onClause);
        $query = $builder->get();
        return $query->getRow();
    }
}
