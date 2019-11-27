

-- -28/07/2011--[global pay (e-sum employee payroll)]-------------------------(sql)-----------------------------by ranil--

create table hs_pr_employee (
       emp_number           int(7) not null,
       emp_name_on_cheque   varchar(500) null,
       sal_dtl_year         numeric null,
       sal_grd_code         varchar(6) null,
       last_modified_date   datetime null,
       emp_update_status    numeric(2) null,
       emp_pf_code          int null,
       vt_sal_code          int null,
       vt_epf_code          int null,
       vt_etf_code          int null,
       dbgroup_user_id      varchar(20) null,
       applied_default_txn  numeric(1) null
)
engine=innodb default charset=utf8;

create index xif2hs_pr_employee on hs_pr_employee
(
       vt_sal_code
)
;

create index xif3hs_pr_employee on hs_pr_employee
(
       vt_epf_code
)
;

create index xif4hs_pr_employee on hs_pr_employee
(
       vt_etf_code
)
;

create table hs_pr_vote_info (
       vt_typ_code          int not null,
       vt_typ_category      numeric(2) null,
       vt_typ_user_code     varchar(20) null,
       vt_typ_name          varchar(200) null
)
engine=innodb default charset=utf8;

-- -28/07/2011--[global pay (e-sum transaction)]-------------------------(sql)-----------------------------by ranil--


create table hs_pr_processedtxn (
       trn_startdate        datetime not null,
       trn_enddate          datetime not null,
       trn_dtl_code         int(6) not null,
       emp_number           int(7) not null,
       trn_proc_emp_amt     numeric(13,2) null,
       trn_proc_eyr_amt     numeric(13,2) null,
       trn_ytd_amount       numeric(13,2) null,
       trn_contribution     numeric(13,2) null,
       trn_hourswkd         numeric(13,2) null,
       dbgroup_user_id      varchar(20) null,
       trn_proc_emp_fullamt numeric(13,2) null,
       trn_ytd_eyr_amount   numeric(13,2) null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_processedtxn on hs_pr_processedtxn
(
       trn_dtl_code
)
;

create index xif2hs_pr_processedtxn on hs_pr_processedtxn
(
       emp_number
)
;

create table hs_pr_transaction_base (
       trn_dtl_code         int(6) not null,
       dbgroup_user_id      varchar(20) null,
       trn_dtl_base_code    int(6) not null,
       trn_base_prev_flg    int(1) null,
       trn_base_use_prorate_flg int(1) null,
       trn_base_dyn_order   numeric(5,2) null
)
engine=innodb default charset=utf8;

create index xif2hs_pr_transaction_base on hs_pr_transaction_base
(
       trn_dtl_code
)
;

create index xif1hs_pr_transaction_base on hs_pr_transaction_base
(
       trn_dtl_base_code
)
;

create table hs_pr_transaction_details (
       trn_dtl_code         int(6) not null,
       trn_dtl_name         varchar(100) null,
       trn_dtl_name_si      varchar(100) null,
       trn_dtl_name_ta      varchar(100) null,
       trn_disable_flg      int(1) null,
       trn_ishourly         int(1) null,
       trn_typ_code         int(6) null,
       trn_dtl_payslipnarration varchar(100) null,
       trn_dtl_payslipnarration_si varchar(100) null,
       trn_dtl_payslipnarration_ta varchar(100) null,
       trn_dtl_addtonetpay  int(1) null,
       trn_dtl_display_order numeric(4) null,
       trn_dtl_isdefault_flg int(1) null,
       trn_dtl_comment      varchar(200) null,
       trn_dtl_isprorate_flg int(1) null,
       trn_dtl_user_code    varchar(10) null,
       trn_dtl_formula      varchar(100) null,
       trn_dtl_isbasetxn_flg int(1) null,
       dbgroup_user_id      varchar(20) null,
       trn_dtl_empcont      numeric(13,2) null,
       trn_dtl_eyrcont      numeric(13,2) null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_transaction_details on hs_pr_transaction_details
(
       trn_typ_code
)
;

create table hs_pr_transaction_group (
       trn_grp_code         int not null,
       trn_grp_name         varchar(20) null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

CREATE TABLE IF NOT EXISTS `hs_pr_transaction_type` (
  `trn_typ_code` int(6) NOT NULL AUTO_INCREMENT,
  `trn_typ_name` varchar(100) DEFAULT NULL,
  `trn_typ_name_si` varchar(100) DEFAULT NULL,
  `trn_typ_name_ta` varchar(100) DEFAULT NULL,
  `trn_typ_type` int(1) DEFAULT NULL,
  `erndedcon` int(1) DEFAULT NULL,
  `trn_typ_user_code` varchar(10) DEFAULT NULL,
  `dbgroup_user_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`trn_typ_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


create table hs_pr_txn_eligibility (
       emp_number           int(7) not null,
       trn_dtl_code         int(6) not null,
       trn_dtl_startdate    date not null,
       trn_dtl_enddate      date not null,
       tre_amount           numeric(13,2) null,
       tre_last_modified_date date null,
       tre_user_id          varchar(150) null,
       tre_stop_flag        varchar(1) null,
       tre_empcon           numeric(13,2) null,
       tre_eyrcon           numeric(13,2) null,
       tre_hours            numeric(8,2) null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif3hs_pr_txn_eligibility on hs_pr_txn_eligibility
(
       emp_number
)
;

create index xif4hs_pr_txn_eligibility on hs_pr_txn_eligibility
(
       trn_dtl_code
)
;

-- -28/07/2011--[global pay (e-sum configuration)]-------------------------(sql)-----------------------------by ranil--


create table hs_pr_pay_freq_type (
       pf_code              int not null,
       pf_name              varchar(20) null,
       pf_description       varchar(100) null,
       pf_enabled_flg       numeric(1) null,
       pf_sort_order        numeric(2,0) null,
       udf_code             varchar(5) null,
       pf_abbrivation       varchar(100) null,
       populate_schedule    numeric(1) null
)
engine=innodb default charset=utf8;

create table hs_pr_pay_schedule (
       pay_sch_id           numeric not null,
       pay_sch_st_date      datetime not null,
       pf_code              int not null,
       pay_sch_end_date     datetime not null,
       pay_sch_processed_flg numeric(1) null,
       pay_sch_disabled_flg numeric(1) null,
       pay_sch_year         numeric(4) null,
       dbgroup_user_id      varchar(20) not null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_pay_schedule on hs_pr_pay_schedule
(
       pf_code
)
;

-- -28/07/2011--[global pay (e-sum salaryincrement)]-------------------------(sql)-----------------------------by ranil--


create table hs_pr_increment (
       emp_number           int(7) not null,
       inc_def_id           numeric not null,
       inc_amount           numeric(13,2) null,
       inc_previous_salary  numeric(13,2) null,
       inc_new_salary       numeric(13,2) null,
       app_approved         numeric(1) null,
       inc_sal_grd_code     varchar(6) null,
       wfmain_id            varchar(6) null,
       inc_previous_point   numeric null,
       wfmain_sequence      numeric null,
       inc_new_point        numeric null,
       inc_isprocessed      smallint null,
       inc_points_increased numeric null,
       wftype_code          numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif4hs_pr_increment on hs_pr_increment
(
       inc_def_id
)
;

create index xif5hs_pr_increment on hs_pr_increment
(
       emp_number
)
;


create table hs_pr_increment_def (
       inc_def_id           numeric not null,
       inc_def_from_date    datetime not null,
       inc_def_to_date      datetime null,
       inc_def_description  varchar(500) null,
       inc_def_posted_year  numeric(2) null,
       inc_def_posted_month numeric(2) null,
       inc_def_user_id      varchar(50) null,
       inc_def_modified_date datetime null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;


-- -28/07/2011--[global pay (e-sum pay process)]-------------------------(sql)-----------------------------by ranil--

create table hs_pr_payprocess (
       pay_startdate        datetime not null,
       emp_number           int(7) not null,
       pay_enddate          datetime not null,
       pay_gross_salary     numeric(13,2) not null,
       pay_netpay           numeric(13,2) not null,
       pay_gross_salary_ytd numeric(13,2) null,
       pay_netpay_ytd       numeric(13,2) null,
       pay_dsg_code         varchar(13) null,
       pay_last_level_hie_code int(6) null,
       pay_cash_paid_amt    numeric(13,2) null,
       pay_bank_paid_amt    numeric(13,2) null,
       pay_paid_salary      numeric(13,2) null,
       pay_grossnet_amt     numeric(13,2) null,
       pay_cf_amt           numeric(13,2) null,
       pay_bf_amt           numeric(13,2) null,
       pay_emp_comnt        varchar(500) null,
       pay_hie_code_1       int(6) null,
       pay_salary_point     numeric null,
       pay_hie_code_2       int(6) null,
       pay_hie_code_6       int(6) null,
       pay_hie_code_4       int(6) null,
       pay_hie_code_3       int(6) null,
       pay_hie_code_5       int(6) null,
       pay_costcenter       varchar(6) null,
       emp_epf_number       varchar(25) null,
       pay_emp_type         varchar(13) null,
       pay_salarygrade      varchar(6) null,
       pay_processed_date   datetime null,
       pay_proc_user        varchar(150) null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_payprocess on hs_pr_payprocess
(
       emp_number
)
;

create index xif14hs_pr_payprocess on hs_pr_payprocess
(
       pay_emp_type
)
;

create index xif16hs_pr_payprocess on hs_pr_payprocess
(
       pay_salarygrade
)
;

create index xif17hs_pr_payprocess on hs_pr_payprocess
(
       pay_costcenter
)
;

create index xif2hs_pr_payprocess on hs_pr_payprocess
(
       pay_last_level_hie_code
)
;

create index xif3hs_pr_payprocess on hs_pr_payprocess
(
       pay_dsg_code
)
;

create index xif4hs_pr_payprocess on hs_pr_payprocess
(
       pay_hie_code_1
)
;

create index xif5hs_pr_payprocess on hs_pr_payprocess
(
       pay_hie_code_2
)
;

create index xif6hs_pr_payprocess on hs_pr_payprocess
(
       pay_hie_code_3
)
;

create index xif7hs_pr_payprocess on hs_pr_payprocess
(
       pay_hie_code_4
)
;

create index xif8hs_pr_payprocess on hs_pr_payprocess
(
       pay_hie_code_5
)
;

create index xif9hs_pr_payprocess on hs_pr_payprocess
(
       pay_hie_code_6
)
;


create table hs_pr_processedemp (
       pro_payfrequency     int(10) not null,
       pro_startdate        datetime not null,
       pro_enddate          datetime not null,
       emp_number           int(7) not null,
       pro_processed        int(1) null,
       pro_inserttime       datetime null,
       pro_batch_id         varchar(100) null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_processedemp on hs_pr_processedemp
(
       emp_number
)
;


-- -28/07/2011--[global pay (e-sum pay taxes)]-------------------------(sql)-----------------------------by ranil--


create table hs_pr_emptaxes (
       tax_code             varchar(5) not null,
       emp_number           int(7) not null,
       is_active            numeric(1) null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_emptaxes on hs_pr_emptaxes
(
       tax_code
)
;

create index xif2hs_pr_emptaxes on hs_pr_emptaxes
(
       emp_number
)
;


create table hs_pr_processedtaxes (
       txp_startdate        datetime not null,
       txp_enddate          datetime not null,
       tax_code             varchar(5) not null,
       emp_number           int(7) not null,
       txp_proc_emp_amt     decimal(13,2) null,
       txp_proc_eyr_amt     decimal(13,2) null,
       txp_eyr_ytd_amt      decimal(13,2) null,
       txp_tot_for_tax      numeric(13,2) null,
       txp_emp_ytd_amt      decimal(13,2) null,
       dbgroup_user_id      varchar(20) null,
       com_tax_from_date    datetime null,
       com_tax_to_date      datetime null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_processedtaxes on hs_pr_processedtaxes
(
       tax_code,
       emp_number
)
;


create table hs_pr_tax_defn (
       tax_code             varchar(5) not null,
       tax_name             varchar(20) not null,
       tax_description      varchar(50) not null,
       tax_com_rate         numeric(5,2) null,
       tax_emp_rate         numeric(5,2) null,
       tax_user_code        varchar(10) null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;


create table hs_pr_taxapplicable (
       trn_dtl_code         int(6) not null,
       tax_code             varchar(5) not null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_taxapplicable on hs_pr_taxapplicable
(
       trn_dtl_code
)
;

create index xif2hs_pr_taxapplicable on hs_pr_taxapplicable
(
       tax_code
)
;

-- -28/07/2011--[global pay (e-sum bank/branch)]-------------------------(sql)-----------------------------by ranil--


create table hs_hr_bank (
       bank_code            varchar(8) not null,
       bank_name            varchar(100) null,
       bank_address         varchar(200) null,
       bnk_main             numeric(1) null,
       bnk_mainbank         varchar(8) null,
       acc_fmt_code         numeric null,
       acc_no_lng           numeric null
)
engine=innodb default charset=utf8;

create index xif1hs_hr_bank on hs_hr_bank
(
       acc_fmt_code
)
;


create table hs_hr_bank_account_type (
       acctype_id           smallint not null,
       acctype_name         varchar(20) null
)
;


create table hs_hr_branch (
       bbranch_sliptransfers_flg numeric(1) null,
       bbranch_auto_clr_house_code varchar(20) null,
       bbranch_address      varchar(200) null,
       bbranch_name         varchar(120) null,
       bbranch_code         varchar(6) not null,
       bank_code            varchar(8) null
)
engine=innodb default charset=utf8;

create index xif1hs_hr_branch on hs_hr_branch
(
       bank_code
)
;


create table hs_hr_emp_bank (
       bbranch_code         varchar(6) not null,
       emp_number           int(7) not null,
       ebank_acc_no         varchar(80) not null,
       ebank_acc_type_flg   smallint not null,
       ebank_amount         decimal(15,2) null,
       ebank_order          numeric null,
       ebank_active_flag    smallint null,
       ebank_start_date     datetime null,
       ebank_end_date       datetime null
)
engine=innodb default charset=utf8;

CREATE TABLE  `hs_pr_profile` (
`id` INT( 10 ) NOT NULL DEFAULT NULL AUTO_INCREMENT ,
`takehome_ptg` VARCHAR( 100 ) NULL DEFAULT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;


create index xif1hs_hr_emp_bank on hs_hr_emp_bank
(
       emp_number
)
;

create index xif2hs_hr_emp_bank on hs_hr_emp_bank
(
       bbranch_code
)
;


create table hs_pr_bank_acc_format (
       acc_fmt_code         numeric not null,
       acc_fmt_exprs        varchar(100) not null,
       acc_fmt_desc         varchar(200) null,
       acc_fmt_errmsg       varchar(500) null
)
engine=innodb default charset=utf8;


create table hs_pr_bank_transfers (
       emp_number           int(7) not null,
       bank_code            varchar(8) not null,
       bbranch_code         varchar(6) not null,
       ebank_acc_no         varchar(80) not null,
       ebt_start_date       datetime not null,
       ebt_end_date         datetime not null,
       ebt_amount           numeric(15,2) null,
       ebank_acc_type_flg   smallint not null,
       ebt_cur_base_amount  numeric(13,2) null
)
engine=innodb default charset=utf8;

create index xif1hs_pr_bank_transfers on hs_pr_bank_transfers
(
       emp_number
)
;

create index xif2hs_pr_bank_transfers on hs_pr_bank_transfers
(
       bank_code
)
;

create index xif3hs_pr_bank_transfers on hs_pr_bank_transfers
(
       bbranch_code
)
;

create index xif5hs_pr_bank_transfers on hs_pr_bank_transfers
(
       ebank_acc_type_flg
)
;






create table hs_pr_cost_centre (
       centre_code          varchar(6) not null,
       centre_name          varchar(120) null,
       hie_code             varchar(6) null
)
engine=innodb default charset=utf8;



create table hs_pr_salary_grade (
       sal_grd_code         varchar(6) not null,
       sal_grd_name         varchar(60) null,
       hie_code             varchar(6) null
)
engine=innodb default charset=utf8;

-- -28/07/2011--[global pay (e-sum)]-------------------------(sql)-----------------------------by ranil--

alter table hs_pr_employee
       add primary key (emp_number)
;


alter table hs_pr_vote_info
       add primary key (vt_typ_code)
;


alter table hs_pr_processedtxn
       add primary key (trn_startdate, trn_enddate, trn_dtl_code,
              emp_number)
;


alter table hs_pr_transaction_base
       add primary key (trn_dtl_base_code, trn_dtl_code)
;


alter table hs_pr_transaction_details
       add primary key (trn_dtl_code)
;


alter table hs_pr_transaction_group
       add primary key (trn_grp_code)
;


-- alter table hs_pr_transaction_type
--       add primary key (trn_typ_code)
-- ;


alter table hs_pr_txn_eligibility
       add primary key (emp_number, trn_dtl_code)
;


alter table hs_pr_pay_freq_type
       add primary key (pf_code)
;


alter table hs_pr_pay_schedule
       add primary key (pay_sch_id, pay_sch_st_date, pf_code,
              pay_sch_end_date, dbgroup_user_id)
;


alter table hs_pr_increment
       add primary key (inc_def_id, emp_number)
;


alter table hs_pr_increment_def
       add primary key (inc_def_id)
;


alter table hs_pr_payprocess
       add primary key (pay_startdate, emp_number, pay_enddate)
;


alter table hs_pr_processedemp
       add primary key (pro_payfrequency, pro_startdate, pro_enddate,
              emp_number)
;



alter table hs_pr_emptaxes
       add primary key (tax_code, emp_number)
;


alter table hs_pr_processedtaxes
       add primary key (txp_startdate, txp_enddate, tax_code,
              emp_number)
;


alter table hs_pr_tax_defn
       add primary key (tax_code)
;


alter table hs_pr_taxapplicable
       add primary key (trn_dtl_code, tax_code)
;


alter table hs_hr_bank
       add primary key (bank_code)
;


alter table hs_hr_bank_account_type
       add primary key (acctype_id)
;


alter table hs_hr_branch
       add primary key (bbranch_code)
;


alter table hs_hr_emp_bank
       add primary key (emp_number, bbranch_code, ebank_acc_no,
              ebank_acc_type_flg)
;

alter table hs_pr_bank_acc_format
       add primary key (acc_fmt_code)
;

alter table hs_pr_bank_transfers
       add primary key (emp_number, bank_code, bbranch_code,
              ebank_acc_no, ebt_start_date, ebt_end_date,
              ebank_acc_type_flg)
;

alter table hs_pr_cost_centre
       add primary key (centre_code)
;

alter table hs_pr_salary_grade
       add primary key (sal_grd_code)
;

--


alter table hs_pr_employee
       add (foreign key (vt_etf_code)
                             references hs_pr_vote_info(vt_typ_code))
;


alter table hs_pr_employee
       add (foreign key (vt_epf_code)
                             references hs_pr_vote_info(vt_typ_code))
;


alter table hs_pr_employee
       add (foreign key (vt_sal_code)
                             references hs_pr_vote_info(vt_typ_code))
;


alter table hs_pr_employee
       add (foreign key (emp_number)
                             references hs_hr_employee(emp_number))
;



alter table hs_pr_processedtxn
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;


alter table hs_pr_processedtxn
       add (foreign key (trn_dtl_code)
                             references hs_pr_transaction_details(trn_dtl_code))
;


 alter table hs_pr_transaction_base
       add (foreign key (trn_dtl_base_code)
                             references hs_pr_transaction_details(trn_dtl_code))
;


alter table hs_pr_transaction_base
       add (foreign key (trn_dtl_code)
                             references hs_pr_transaction_details(trn_dtl_code))
;


alter table hs_pr_transaction_details
       add (foreign key (trn_typ_code)
                             references hs_pr_transaction_type(trn_typ_code))
;


alter table hs_pr_txn_eligibility
       add (foreign key (trn_dtl_code)
                             references hs_pr_transaction_details(trn_dtl_code))
;


alter table hs_pr_txn_eligibility
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;


alter table hs_pr_pay_schedule
       add (foreign key (pf_code)
                             references hs_pr_pay_freq_type(pf_code))
;


alter table hs_pr_increment
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;


alter table hs_pr_increment
       add (foreign key (inc_def_id)
                             references hs_pr_increment_def(inc_def_id))
;



alter table hs_pr_payprocess
       add (foreign key (pay_costcenter)
                             references hs_pr_cost_centre(centre_code))
;


alter table hs_pr_payprocess
       add (foreign key (pay_salarygrade)
                             references hs_pr_salary_grade(sal_grd_code))
;


alter table hs_pr_payprocess
       add (foreign key (pay_emp_type)
                             references hs_hr_empstat(estat_code))
;

alter table hs_pr_payprocess
       add (foreign key (pay_hie_code_6)
                             references hs_hr_compstructtree(id))
;


alter table hs_pr_payprocess
       add (foreign key (pay_hie_code_5)
                             references hs_hr_compstructtree(id))
;


alter table hs_pr_payprocess
       add (foreign key (pay_hie_code_4)
                             references hs_hr_compstructtree(id))
;


alter table hs_pr_payprocess
       add (foreign key (pay_hie_code_3)
                             references hs_hr_compstructtree(id))
;


alter table hs_pr_payprocess
       add (foreign key (pay_hie_code_2)
                             references hs_hr_compstructtree(id))
;


alter table hs_pr_payprocess
       add (foreign key (pay_hie_code_1)
                             references hs_hr_compstructtree(id))
;


alter table hs_pr_payprocess
       add (foreign key (pay_dsg_code)
                             references hs_hr_job_title(jobtit_code))
;


alter table hs_pr_payprocess
       add (foreign key (pay_last_level_hie_code)
                             references hs_hr_compstructtree(id))
;


alter table hs_pr_payprocess
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;


alter table hs_pr_processedemp
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;


alter table hs_pr_emptaxes
       add (foreign key (emp_number)
                             references hs_pr_employee(emp_number))
;


alter table hs_pr_emptaxes
       add (foreign key (tax_code)
                             references hs_pr_tax_defn(tax_code))
;


alter table hs_pr_processedtaxes
       add (foreign key (tax_code, emp_number)
                             references hs_pr_emptaxes(tax_code, emp_number))
;


alter table hs_pr_taxapplicable
       add (foreign key (tax_code)
                             references hs_pr_tax_defn(tax_code))
;


alter table hs_pr_taxapplicable
       add (foreign key (trn_dtl_code)
                             references hs_pr_transaction_details(trn_dtl_code))
;


alter table hs_hr_bank
       add (foreign key (acc_fmt_code)
                             references hs_pr_bank_acc_format(acc_fmt_code))
;


alter table hs_hr_branch
       add (foreign key (bank_code)
                             references hs_hr_bank(bank_code))
;


alter table hs_hr_emp_bank
       add (foreign key (bbranch_code)
                             references hs_hr_branch(bbranch_code))
;


alter table hs_hr_emp_bank
       add (foreign key (emp_number)
                             references hs_hr_employee(emp_number))
;


alter table hs_pr_bank_transfers
       add (foreign key (bbranch_code)
                             references hs_hr_branch(bbranch_code))
;


alter table hs_pr_bank_transfers
       add (foreign key (bank_code)
                             references hs_hr_bank(bank_code))
;


alter table hs_pr_bank_transfers
       add (foreign key (emp_number)
                             references hs_hr_employee(emp_number))
;

alter table hs_hr_bank
       add (foreign key (acc_fmt_code)
                             references hs_pr_bank_acc_format(acc_fmt_code))
;












