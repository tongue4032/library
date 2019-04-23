    <?php
    
    /**
     * =======================================
     * Created by Pocket Knife Technology.
     * User: ZhiHua_W
     * Date: 2016/11/08 0041
     * Time: 下午 4:14
     * Project: CodeIgniter框架—源码分析
     * Power: Analysis for Pagination.php
     * =======================================
     */
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    /**
     * 用于生成分页连接
     */
    class CI_Pagination
    {
        //每次访问的url地址
        protected $base_url = 'dev.ad.com/Admin/show_books/';
        //给路径添加一个自定义前缀，前缀位于偏移段的前面
        protected $prefix = '';
        //给路径添加一个自定义后缀，后缀位于偏移段的后面。
        protected $suffix = '';
        //这个数字表示你需要做分页的数据的总行数。通常这个数值是你查询数据库得到的数据总量。
        protected $total_rows = 0;
        //放在你当前页码的前面和后面的“数字”链接的数量。
        //比方说值为 2 就会在每一边放置两个数字链接，就像此页顶端的示例链接那样。
        protected $num_links = 2;
        //这个数字表示每个页面中希望展示的数量，在上面的那个例子中，每页显示 10 个项目。
        public $per_page = 10;
        //当前页
        public $cur_page = 0;
        //默认分页的 URL 中显示的是你当前正在从哪条记录开始分页，
        //如果你希望显示实际的页数，将该参数设置为 TRUE 。
        protected $use_page_numbers = FALSE;
        //首页，左边第一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        protected $first_link = '‹ First';
        //下一页，下一页链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        protected $next_link = FALSE;
        //下一页，下一页链接显示的文本，如果你不想显示该链接，将其设置为 FALSE
        protected $prev_link = FALSE;
        //尾页，右边第一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        protected $last_link = 'Last ›';
        //分页方法自动检测你 URI 的哪一段包含页数，如果你的情况不一样，你可以明确指定它
        protected $uri_segment = 4;
        //起始标签放在所有结果的左侧。
        //你可以在标签里面写任意的样式等等
        //不过样式最好的还是采取分离的方式写最好，仅在这边添加不同的class就可以了
        protected $full_tag_open = '<ul class="pagination pagination-sm">';
        //结束标签放在所有结果的右侧。
        protected $full_tag_close = '</ul>';
        //第一个链接的起始标签。
        protected $first_tag_open = '<li>';
        //第一个链接的结束标签。
        protected $first_tag_close = '</li>';
        //最后一个链接的起始标签。
        protected $last_tag_open = '<li>';
        //最后一个链接的结束标签。
        protected $last_tag_close = '</li>';
        //首页url
        protected $first_url = '';
        //当前页链接的起始标签。
        protected $cur_tag_open = '<li class="active"><a href="javascript:;">';
        //当前页链接的结束标签。
        protected $cur_tag_close = '</a></li>';
        //下一页链接的起始标签。
        protected $next_tag_open = '<li>';
        //下一页链接的结束标签。
        protected $next_tag_close = '</li>';
        //上一页链接的起始标签。
        protected $prev_tag_open = '<li>';
        //上一页链接的结束标签。
        protected $prev_tag_close = '</li>';
        //数字链接的起始标签。
        protected $num_tag_open = '<li>';
        //数字链接的结束标签。
        protected $num_tag_close = '</li>';
        //默认情况下，分页类假设你使用 URI 段 ，并像这样构造你的链接:
        //http://example.com/index.php/test/page/20
        protected $page_query_string = FALSE;
        protected $query_string_segment = 'per_page';
        //如果你不想显示数字链接（例如你只想显示上一页和下一页链接），你可以通过下面的代码来阻止它显示
        protected $display_pages = TRUE;
        //如果你想为分页类生成的每个链接添加额外的属性
        protected $_attributes = '';
        //连接类型
        protected $_link_types = array();
        //默认情况下你的查询字符串参数会被忽略，将这个参数设置为 TRUE ，
        //将会将查询字符串参数添加到 URI 分段的后面以及 URL 后缀的前面
        protected $reuse_query_string = FALSE;
        //当该参数设置为 TRUE 时，会使用 application/config/config.php
        //配置文件中定义的 $config['url_suffix'] 参数 重写 $config['suffix'] 的值
        protected $use_global_url_suffix = FALSE;
        //给数字增加属性
        protected $data_page_attr = 'data-ci-pagination-page';
        //CI Singleton
        protected $CI;
    
        /**
         * 构造函数->处理数据
         * 在使用加载此类之后，设置一些数据例如：
         * //配置分页信息
         * $config['base_url'] = site_url('admin/goodstype/index');
         * $config['total_rows'] = $this->goodstype_model->count_goodstype();
         * $config['per_page'] = 2;
         * $config['uri_segment'] = 4;
         *
         * //自定义分页连接
         * $config['first_link'] = '首页';
         * $config['last_link'] = '尾页';
         * $config['prev_link'] = '上一页';
         * $config['next_link'] = '下一页';
         */
        public function __construct($params = array())
        {
            $this->CI = &get_instance();
            $this->CI->load->language('pagination');
            foreach (array('first_link', 'next_link', 'prev_link', 'last_link') as $key) {
                if (($val = $this->CI->lang->line('pagination_' . $key)) !== FALSE) {
                    $this->$key = $val;
                }
            }
            $this->initialize($params);
            log_message('info', 'Pagination Class Initialized');
        }
    
        /**
         * 初始化
         * 功能同样是处理参数
         */
        public function initialize(array $params = array())
        {
            isset($params['attributes']) OR $params['attributes'] = array();
            if (is_array($params['attributes'])) {
                $this->_parse_attributes($params['attributes']);
                unset($params['attributes']);
            }
    
            if (isset($params['anchor_class'])) {
                empty($params['anchor_class']) OR $attributes['class'] = $params['anchor_class'];
                unset($params['anchor_class']);
            }
    
            foreach ($params as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
    
            if ($this->CI->config->item('enable_query_strings') === TRUE) {
                $this->page_query_string = TRUE;
            }
    
            if ($this->use_global_url_suffix === TRUE) {
                $this->suffix = $this->CI->config->item('url_suffix');
            }
    
            return $this;
        }
    
        /**
         * 创建分页连接
         * 这个就是我们需要条用到的了，这个函数最后会返回一串html代码，
         * 而我们仅将这段html代码在前台显示即可。
         * CI框架的分页类和TP框架的分页类有这明显的差别。
         * CI仅是提供分页显示，并不提供其和数据库交互的功能。
         * 这也就让我们可以对其进行100%的定制。
         * 非常的小巧方便。
         */
        public function create_links()
        {
            //我们在初始化的时候必须要有数据总条数和每页显示条数
            if ($this->total_rows == 0 OR $this->per_page == 0) {
                return '';
            }
            //计算页面总数
            $num_pages = (int)ceil($this->total_rows / $this->per_page);
            //如果只有一页，则直接然会空字符串
            if ($num_pages === 1) {
                return '';
            }
            //检查用户定义的链接数
            $this->num_links = (int)$this->num_links;
            if ($this->num_links < 0) {
                show_error('Your number of links must be a non-negative number.');
            }
    
            //保留任何现有的查询字符串项目。
            //注：与任何其他查询字符串选项无关。
            if ($this->reuse_query_string === TRUE) {
                $get = $this->CI->input->get();
                unset($get['c'], $get['m'], $get[$this->query_string_segment]);
            } else {
                $get = array();
            }
    
            //处理我们的基础网址和第一个网址
            $base_url = trim($this->base_url);
            $first_url = $this->first_url;
            $query_string = '';
            $query_string_sep = (strpos($base_url, '?') === FALSE) ? '?' : '&';
            if ($this->page_query_string === TRUE) {
                //如果自定义first_url还没有被确定，我们会从base_url创建一个网页，但没有项目。
                if ($first_url === '') {
                    $first_url = $base_url;
                    if (!empty($get)) {
                        $first_url .= $query_string_sep . http_build_query($get);
                    }
                }
                $base_url .= $query_string_sep . http_build_query(array_merge($get, array($this->query_string_segment => '')));
            } else {
                //生成我们保存的查询字符串，以在页面号以后追加。
                if (!empty($get)) {
                    $query_string = $query_string_sep . http_build_query($get);
                    $this->suffix .= $query_string;
                }
                if ($this->reuse_query_string === TRUE && ($base_query_pos = strpos($base_url, '?')) !== FALSE) {
                    $base_url = substr($base_url, 0, $base_query_pos);
                }
                if ($first_url === '') {
                    $first_url = $base_url . $query_string;
                }
    
                $base_url = rtrim($base_url, '/') . '/';
            }
    
            //确定当前页号。
            $base_page = ($this->use_page_numbers) ? 1 : 0;
            //判断我们是否使用查询字符串
            if ($this->page_query_string === TRUE) {
                $this->cur_page = $this->CI->input->get($this->query_string_segment);
            } elseif (empty($this->cur_page)) {
                //如果uri_segment一个没有被定义，默认的最后一个段的数字。
                if ($this->uri_segment === 0) {
                    $this->uri_segment = count($this->CI->uri->segment_array());
                }
                $this->cur_page = $this->CI->uri->segment($this->uri_segment);
                //从该段中删除任何指定的前缀/后缀。
                if ($this->prefix !== '' OR $this->suffix !== '') {
                    $this->cur_page = str_replace(array($this->prefix, $this->suffix), '', $this->cur_page);
                }
            } else {
                $this->cur_page = (string)$this->cur_page;
            }
            if (!ctype_digit($this->cur_page) OR ($this->use_page_numbers && (int)$this->cur_page === 0)) {
                $this->cur_page = $base_page;
            } else {
                //确保我们使用的是比较后的整数。
                $this->cur_page = (int)$this->cur_page;
            }
            if ($this->use_page_numbers) {
                if ($this->cur_page > $num_pages) {
                    $this->cur_page = $num_pages;
                }
            } elseif ($this->cur_page > $this->total_rows) {
                $this->cur_page = ($num_pages - 1) * $this->per_page;
            }
    
            $uri_page_number = $this->cur_page;
            //如果我们使用的是偏移量而不是页面号，将它转换为一个页面号，
            //这样我们就可以生成周围的数字链接了。
            if (!$this->use_page_numbers) {
                $this->cur_page = (int)floor(($this->cur_page / $this->per_page) + 1);
            }
    
            //计算开始和结束的数字。这些决定开始和结束数字链接的数量。
            $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
            $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
    
            //这个变量就是最后返回的字符串
            $output = '';
    
            //生成首页链接
            if ($this->first_link !== FALSE && $this->cur_page > ($this->num_links + 1 + !$this->num_links)) {
                //为html代码添加设置的js属性
                $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, 1);
                $output .= $this->first_tag_open . '<a href="' . $first_url . '"' . $attributes . $this->_attr_rel('start') . '>' . $this->first_link . '</a>' . $this->first_tag_close;
            }
    
            // 生成上一页链接
            //我个人感觉生成上一页的这个连接没用，我们本身已经有了和相邻的页面连接
            //故而上一页和下一页在我看来没有用处，我一般都是将此段和下一页都注视掉
            if ($this->prev_link !== FALSE && $this->cur_page !== 1) {
                $i = ($this->use_page_numbers) ? $uri_page_number - 1 : $uri_page_number - $this->per_page;
                $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, ($this->cur_page - 1));
                if ($i === $base_page) {
                    $output .= $this->prev_tag_open . '<a href="' . $first_url . '"' . $attributes . $this->_attr_rel('prev') . '>' . $this->prev_link . '</a>' . $this->prev_tag_close;
                } else {
                    $append = $this->prefix . $i . $this->suffix;
                    $output .= $this->prev_tag_open . '<a href="' . $base_url . $append . '"' . $attributes . $this->_attr_rel('prev') . '>' . $this->prev_link . '</a>' . $this->prev_tag_close;
                }
            }
            //渲染页面
            //也就是将你设置的所需要添加的html标签代码，属性，都给加上
            if ($this->display_pages !== FALSE) {
                for ($loop = $start - 1; $loop <= $end; $loop++) {
                    $i = ($this->use_page_numbers) ? $loop : ($loop * $this->per_page) - $this->per_page;
                    $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, $loop);
                    if ($i >= $base_page) {
                        if ($this->cur_page === $loop) {
                            $output .= $this->cur_tag_open . $loop . $this->cur_tag_close;
                        } elseif ($i === $base_page) {
                            $output .= $this->num_tag_open . '<a href="' . $first_url . '"' . $attributes . $this->_attr_rel('start') . '>' . $loop . '</a>' . $this->num_tag_close;
                        } else {
                            $append = $this->prefix . $i . $this->suffix;
                            $output .= $this->num_tag_open . '<a href="' . $base_url . $append . '"' . $attributes . '>' . $loop . '</a>' . $this->num_tag_close;
                        }
                    }
                }
            }
            //生成下一页连接
            //不多说
            if ($this->next_link !== FALSE && $this->cur_page < $num_pages) {
                $i = ($this->use_page_numbers) ? $this->cur_page + 1 : $this->cur_page * $this->per_page;
                $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, $this->cur_page + 1);
                $output .= $this->next_tag_open . '<a href="' . $base_url . $this->prefix . $i . $this->suffix . '"' . $attributes . $this->_attr_rel('next') . '>' . $this->next_link . '</a>' . $this->next_tag_close;
            }
            //生成最后一页（尾页）连接
            if ($this->last_link !== FALSE && ($this->cur_page + $this->num_links + !$this->num_links) < $num_pages) {
                $i = ($this->use_page_numbers) ? $num_pages : ($num_pages * $this->per_page) - $this->per_page;
                $attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, $num_pages);
                $output .= $this->last_tag_open . '<a href="' . $base_url . $this->prefix . $i . $this->suffix . '"' . $attributes . '>' . $this->last_link . '</a>' . $this->last_tag_close;
            }
            //将生成的结果html代码字符串进行处理
            $output = preg_replace('#([^:"])//+#', '\\1/', $output);
            //如果存在添加封装HTML
            return $this->full_tag_open . $output . $this->full_tag_close;
        }
    
        /**
         * 解析属性
         */
        protected function _parse_attributes($attributes)
        {
            isset($attributes['rel']) OR $attributes['rel'] = TRUE;
            $this->_link_types = ($attributes['rel']) ? array('start' => 'start', 'prev' => 'prev', 'next' => 'next') : array();
            unset($attributes['rel']);
            $this->_attributes = '';
            foreach ($attributes as $key => $value) {
                $this->_attributes .= ' ' . $key . '="' . $value . '"';
            }
        }
    
        /**
         * 添加“关系”属性
         */
        protected function _attr_rel($type)
        {
            if (isset($this->_link_types[$type])) {
                unset($this->_link_types[$type]);
                return ' rel="' . $type . '"';
            }
            return '';
        }
    
    }