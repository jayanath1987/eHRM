
-- -28/07/2011--[global pay (e-sum loan)]-------------------------(sql)-----------------------------by ranil--

create table hs_ln_application (
       ln_app_number        numeric not null,
       emp_number           int(7) not null,
       ln_ty_number         numeric not null,
       ln_app_date          datetime null,
       ln_app_amount        numeric(18,2) null,
       ln_app_installment   numeric null,
       ln_app_elg_amount    numeric(18,2) null,
       ln_app_install_amount numeric(13,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_app_effective_date datetime null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_application on hs_ln_application
(
       ln_ty_number
)
;

create table hs_ln_checklist (
       ln_chk_cat_number    numeric not null,
       ln_chk_number        numeric not null,
       ln_chk_description   varchar(200) null,
       ln_chk_is_mandatory_flg numeric(1) null,
       ln_chk_type_flg      numeric(1) null,
       ln_chk_no_of_gurantee numeric null,
       module_code          varchar(20) null,
       formula_name         varchar(100) null,
       ln_chk_validate_req_flg numeric(1) null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_checklist on hs_ln_checklist
(
       ln_chk_cat_number
)
;


create table hs_ln_checklist_catagory (
       ln_chk_cat_number    numeric not null,
       ln_chk_cat_name      varchar(100) null,
       ln_chk_cat_type      numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;


create table hs_ln_document (
       ln_doc_number        numeric not null,
       ln_app_number        numeric not null,
       ln_ty_number         numeric not null,
       ln_doc_source        mediumblob null,
       ln_doc_ext           varchar(10) null,
       ln_chk_number        numeric null,
       ln_chk_cat_number    numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_document on hs_ln_document
(
       ln_chk_number,
       ln_chk_cat_number
)
;

create index xif2hs_ln_document on hs_ln_document
(
       ln_app_number,
       ln_ty_number
)
;



create table hs_ln_entitlement_detail (
       ln_ent_group_number  numeric not null,
       emp_number           int(7) not null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif2hs_ln_entitlement_detail on hs_ln_entitlement_detail
(
       ln_ent_group_number
)
;



create table hs_ln_entitlement_group (
       ln_ent_group_number  numeric not null,
       ln_ent_description   varchar(200) null,
       elgrp_id             numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;



create table hs_ln_guarantee (
       ln_gura_number       numeric not null,
       ln_app_number        numeric not null,
       ln_ty_number         numeric not null,
       ln_gura_external_flg numeric(1) null,
       emp_number           int(7) null,
       ln_gura_firstname    varchar(200) null,
       ln_gura_middle_name  varchar(200) null,
       ln_gura_surname      varchar(200) null,
       ln_gura_tel          varchar(20) null,
       ln_gura_address1     varchar(200) null,
       ln_gura_address2     varchar(200) null,
       ln_gura_address3     varchar(200) null,
       ln_gura_comment      varchar(400) null,
       ln_chk_number        numeric null,
       ln_chk_cat_number    numeric null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_guarantee on hs_ln_guarantee
(
       ln_app_number,
       ln_ty_number
)
;

create index xif3hs_ln_guarantee on hs_ln_guarantee
(
       ln_chk_number,
       ln_chk_cat_number
)
;



create table hs_ln_header (
       emp_number           int(7) not null,
       ln_app_number        numeric null,
       ln_ty_number         numeric not null,
       ln_hd_sequence       numeric not null,
       ln_hd_amount         numeric(18,2) null,
       ln_hd_bal_amount     numeric(18,2) null,
       ln_hd_installment    numeric null,
       ln_hd_is_active_flg  numeric(1) null,
       ln_hd_settled_flg    numeric(1) null,
       ln_hd_user           varchar(100) null,
       ln_hd_apply_date     datetime null,
       ln_hd_bal_installment numeric null,
       app_approved         numeric(1) null,
       wfmain_id            varchar(6) null,
       ln_hd_lst_proc_to_date datetime null,
       wfmain_sequence      numeric null,
       ln_hd_lst_proc_from_date datetime null,
       ln_hd_effective_date datetime null,
       ln_hd_inactive_period numeric null,
       ln_hd_install_amount numeric(13,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_hd_app_date       datetime null,
       cancel_approved      numeric(5) null,
       cancel_main_id       varchar(6) null
)
engine=innodb default charset=utf8;

create index xif2hs_ln_header on hs_ln_header
(
       ln_ty_number
)
;

create index xif4hs_ln_header on hs_ln_header
(
       ln_app_number,
       ln_ty_number
)
;




create table hs_ln_processed_loan (
       emp_number           int(7) not null,
       ln_hd_sequence       numeric not null,
       ln_sch_ins_no        numeric not null,
       ln_ty_number         numeric not null,
       ln_processed_from_date datetime not null,
       ln_processed_to_date datetime not null,
       ln_processed_capital numeric(18,2) null,
       ln_processed_interest numeric(18,2) null,
       ln_interest_rate     numeric(13,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_bal_installment   numeric null,
       ln_bal_amount        numeric(18,2) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_processed_loan on hs_ln_processed_loan
(
       emp_number,
       ln_hd_sequence,
       ln_sch_ins_no,
       ln_ty_number
)
;




create table hs_ln_schedule (
       emp_number           int(7) not null,
       ln_hd_sequence       numeric not null,
       ln_sch_ins_no        numeric not null,
       ln_ty_number         numeric not null,
       ln_sch_cap_amt       numeric(18,2) null,
       ln_sch_inst_amount   numeric(13,2) null,
       ln_st_number         numeric null,
       ln_sch_is_processed  numeric(1) null,
       ln_sch_inst_rate     numeric(5,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_sch_proc_to_date  datetime null,
       ln_sch_proc_from_date datetime null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_schedule on hs_ln_schedule
(
       emp_number,
       ln_hd_sequence,
       ln_ty_number
)
;

create index xif2hs_ln_schedule on hs_ln_schedule
(
       ln_st_number
)
;



create table hs_ln_settlement (
       ln_st_number         numeric not null,
       emp_number           int(7) not null,
       ln_hd_sequence       numeric not null,
       ln_st_date           datetime null,
       ln_st_user           varchar(100) null,
       ln_st_amount         numeric(18,2) null,
       ln_st_installment    numeric null,
       ln_st_mode           numeric(1) null,
       ln_st_last_installment_number numeric null,
       ln_ty_number         numeric null,
       dbgroup_user_id      varchar(20) null,
       ln_st_interest_amount numeric(13,2) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_settlement on hs_ln_settlement
(
       emp_number,
       ln_hd_sequence,
       ln_ty_number
)
;



create table hs_ln_type (
       ln_ty_number         numeric not null,
       elgrp_id             numeric null,
       ln_ty_description    varchar(100) null,
       ln_ty_max_installment numeric null,
       ln_ty_interest_rate  numeric(5,2) null,
       ln_ty_modified_date  datetime null,
       ln_ty_modified_user  varchar(100) null,
       ln_ty_amount         numeric(18,2) null,
       ln_ty_app_req_flg    numeric(1) null,
       ln_ty_active_flg     numeric(1) null,
       wftype_code          numeric null,
       ln_ent_group_number  numeric null,
       ln_ty_entitlement_type_flg numeric(1) null,
       ln_ty_interest_fixed_amt numeric(13,2) null,
       ln_ty_interest_type  numeric(1) null,
       ln_ty_user_code      varchar(10) null,
       ln_ty_takehm_req_flg numeric(1) null,
       ln_ty_takehm_ptg     numeric(5,2) null,
       dbgroup_user_id      varchar(20) null,
       ln_ty_inactive_type_flg numeric(1) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_type on hs_ln_type
(
       ln_ent_group_number
)
;



create table hs_ln_type_check (
       ln_ty_number         numeric not null,
       ln_chk_cat_number    numeric not null,
       dbgroup_user_id      varchar(20) null
)
engine=innodb default charset=utf8;

create index xif1hs_ln_type_check on hs_ln_type_check
(
       ln_chk_cat_number
)
;

create index xif2hs_ln_type_check on hs_ln_type_check
(
       ln_ty_number
)
;

-- -28/07/2011--[Loan]-------------------------(SQL)-----------------------------By Ranil--

alter table hs_ln_application
       add primary key (ln_app_number, ln_ty_number)
;


alter table hs_ln_checklist
       add primary key (ln_chk_number, ln_chk_cat_number)
;


alter table hs_ln_checklist_catagory
       add primary key (ln_chk_cat_number)
;


alter table hs_ln_document
       add primary key (ln_doc_number)
;


alter table hs_ln_entitlement_detail
       add primary key (ln_ent_group_number, emp_number)
;


alter table hs_ln_entitlement_group
       add primary key (ln_ent_group_number)
;


alter table hs_ln_guarantee
       add primary key (ln_gura_number)
;


alter table hs_ln_header
       add primary key (emp_number, ln_hd_sequence, ln_ty_number)
;


alter table hs_ln_processed_loan
       add primary key (emp_number, ln_hd_sequence, ln_sch_ins_no,
              ln_ty_number, ln_processed_from_date,
              ln_processed_to_date)
;


alter table hs_ln_schedule
       add primary key (emp_number, ln_hd_sequence, ln_sch_ins_no,
              ln_ty_number)
;



alter table hs_ln_settlement
       add primary key (ln_st_number)
;



alter table hs_ln_type
       add primary key (ln_ty_number)
;


alter table hs_ln_type_check
       add primary key (ln_ty_number, ln_chk_cat_number)
;


alter table hs_ln_application
       add (foreign key (ln_ty_number)
                             references hs_ln_type(ln_ty_number))
;


alter table hs_ln_checklist
       add (foreign key (ln_chk_cat_number)
                             references hs_ln_checklist_catagory(ln_chk_cat_number))
;


alter table hs_ln_document
       add (foreign key (ln_app_number, ln_ty_number)
                             references hs_ln_application(ln_app_number, ln_ty_number))
;


alter table hs_ln_document
       add (foreign key (ln_chk_number, ln_chk_cat_number)
                             references hs_ln_checklist(ln_chk_number, ln_chk_cat_number))
;


alter table hs_ln_entitlement_detail
       add (foreign key (ln_ent_group_number)
                             references hs_ln_entitlement_group(ln_ent_group_number))
;


alter table hs_ln_guarantee
       add (foreign key (ln_chk_number, ln_chk_cat_number)
                             references hs_ln_checklist(ln_chk_number, ln_chk_cat_number))
;


alter table hs_ln_guarantee
       add (foreign key (ln_app_number, ln_ty_number)
                             references hs_ln_application(ln_app_number, ln_ty_number))
;


alter table hs_ln_header
       add (foreign key (ln_app_number, ln_ty_number)
                             references hs_ln_application(ln_app_number, ln_ty_number))
;


alter table hs_ln_header
       add (foreign key (ln_ty_number)
                             references hs_ln_type(ln_ty_number))
;


alter table hs_ln_processed_loan
       add (foreign key (emp_number, ln_hd_sequence, ln_sch_ins_no,
              ln_ty_number)
                             references hs_ln_schedule(emp_number, ln_hd_sequence, ln_sch_ins_no,
              ln_ty_number))
;


alter table hs_ln_schedule
       add (foreign key (ln_st_number)
                             references hs_ln_settlement(ln_st_number))
;


alter table hs_ln_schedule
       add (foreign key (emp_number, ln_hd_sequence, ln_ty_number)
                             references hs_ln_header(emp_number, ln_hd_sequence, ln_ty_number))
;


alter table hs_ln_settlement
       add (foreign key (emp_number, ln_hd_sequence, ln_ty_number)
                             references hs_ln_header(emp_number, ln_hd_sequence, ln_ty_number))
;


alter table hs_ln_type
       add (foreign key (ln_ent_group_number)
                             references hs_ln_entitlement_group(ln_ent_group_number))
;


alter table hs_ln_type_check
       add (foreign key (ln_ty_number)
                             references hs_ln_type(ln_ty_number))
;


alter table hs_ln_type_check
       add (foreign key (ln_chk_cat_number)
                             references hs_ln_checklist_catagory(ln_chk_cat_number))
;
