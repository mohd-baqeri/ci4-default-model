# ci4-default-model
A MUST model for CodeIgniter 4 projects.

INSTALLATION:
  Just download the file "DefaultModel.php" and put it in your CodeIgniter project's "Models" directory.

Full CRUD functions for Codeigniter 4 using Query Builder.

  The code example in a controller:
  
    private $model;
    
    public function __construct()
    {
        $this->model = new DefaultModel();
    }

    public function index()
    {
        $data = [
          'firstname' => 'Mohammad', // Your input data
          'lastname' => 'Baqeri', // Your input data
        ];
        $id = $this->model->addRow('users', $data);
    }


By the following functions, you can do whatever can be done by a model:

     * addRow($tbl, $data)

     * addRows($tbl, $data)
     
     * updateRow($tbl, $data, $where = [])
     
     * deleteRow($tbl, $where = [], $status = 'delete')

     * getRows($tbl, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsIn($tbl, $whereInCol, $whereInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsInJoin($tbl1, $tbl2, $onClause, $select = '*', $whereInCol, $whereInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsInSearch($tbl, $whereInCol, $whereInVal, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsNotIn($tbl, $whereNotInCol, $whereNotInVal, $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsNotInSearch($tbl, $whereNotInCol, $whereNotInVal, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsSearch($tbl, $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getRowsSearchJoin($tbl1, $tbl2, $onClause, $select = '*', $like = [], $where = [], $orderBy = 'id ASC', $limit = false, $offset = false)

     * getDistinctRows($tbl, $distinct_col, $where = [], $orderBy = NULL, $limit = false, $offset = false)

     * getDistinctRowsSearch($tbl, $distinct_col, $like = [], $where = [], $orderBy = NULL, $limit = false, $offset = false)

     * getRow($tbl, $where = [], $orderBy = NULL)

     * getRowIn($tbl, $whereInCol, $whereInVal, $where = [])

     * getRowNotIn($tbl, $whereNotInCol, $whereNotInVal, $where = [])

     * getNextRow($tbl, $current_col_name, $current_col_val, $where = [])

     * getNextRows($tbl, $current_col_name, $current_col_val, $where = [], $limit = false, $offset = false)

     * getPrevRow($tbl, $current_col_name, $current_col_val, $where = [])

     * getPrevRows($tbl, $current_col_name, $current_col_val, $where = [], $limit = false, $offset = false)

     * getFirstRow($tbl, $where = [], $orderBy = 'id ASC')

     * getLastRow($tbl, $where = [], $orderBy = 'id DESC')

     * getRowMath($tbl, $math = 'SUM', $col = 'id', $where = [])

     * getRowMathSearch($tbl, $math = 'SUM', $col = 'id', $like = [], $where = [])

     * getRowJoin($tbl1, $tbl2, $onClause, $select = '*', $where = [], $orderBy = '')
     
*Note:* It's based on the Query Builder Model.
