CREATE view tien_cd_dadong SELECT chidoan.TEN_CD, namhoc.TEN_NH,(count(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI) as tien_cd_dadong
FROM doanvien_thanhnien, chidoan, doankhoa, namhoc, thangnam, doanphi_thu_cd
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
AND doankhoa.ID = chidoan.DOANKHOA_ID
AND chidoan.ID = doanphi_thu_cd.CHIDOAN_ID
AND thangnam.ID = doanphi_thu_cd.THANGNAM_ID
AND namhoc.ID = thangnam.NAMHOC_ID
GROUP BY chidoan.TEN_CD, namhoc.TEN_NH, thangnam.SOTIEN_DOANPHI

SELECT chidoan.TEN_CD, namhoc.TEN_NH,(count(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)/3 as tien_cd_dadong
FROM doanvien_thanhnien, chidoan, doankhoa, namhoc, thangnam
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
AND doankhoa.ID = chidoan.DOANKHOA_ID
AND namhoc.ID = thangnam.NAMHOC_ID
GROUP BY chidoan.TEN_CD, namhoc.TEN_NH, thangnam.SOTIEN_DOANPHI


SELECT chidoan.TEN_CD, doankhoa.TEN_DK, namhoc.TEN_NH, thangnam.THANGNAM, count(doanvien_thanhnien.ID) as soluong_dv
FROM doanvien_thanhnien, chidoan, doankhoa, namhoc, thangnam, doanphi_thu_cd
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
AND doankhoa.ID = chidoan.DOANKHOA_ID
AND chidoan.ID = doanphi_thu_cd.CHIDOAN_ID
AND thangnam.ID = doanphi_thu_cd.THANGNAM_ID
AND namhoc.ID = thangnam.NAMHOC_ID
GROUP BY chidoan.TEN_CD, doankhoa.TEN_DK, namhoc.TEN_NH, thangnam.THANGNAM


SELECT chidoan.TEN_CD, count(doanvien_thanhnien.ID) as soluong_dv
FROM doanvien_thanhnien, chidoan
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
where 
GROUP BY chidoan.TEN_CD

select chidoan.ID, chidoan.TEN_CD, count(DOANVIEN_THANHNIEN_ID) as sl_doanvien 
from doanvien_thanhnien, chidoan, qd_dv_ttdoan
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
and qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID != doanvien_thanhnien.ID
AND qd_dv_ttdoan.DUYET_TTD is null
and doanvien_thanhnien.NGAYCHUYENSH_SV is null
AND doanvien_thanhnien.NGAYVAODOAN_SV is not null
GROUP BY chidoan.ID

create view soluong_dv as SELECT chidoan.ID, chidoan.TEN_CD, count(doanvien_thanhnien.ID) as soluong_dv
FROM doanvien_thanhnien, chidoan
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
GROUP BY chidoan.TEN_CD

SELECT namhoc.TEN_NH, chidoan.TEN_CD,(v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI) as sotien_cd_dong_1_thang 
FROM v_soluong_dv, chidoan, doankhoa, thangnam, namhoc
WHERE v_soluong_dv.ID = chidoan.ID
AND doankhoa.ID = chidoan.DOANKHOA_ID
AND namhoc.ID = thangnam.NAMHOC_ID
GROUP BY thangnam.SOTIEN_DOANPHI, namhoc.TEN_NH, chidoan.TEN_CD


CREATE VIEW v_sotien_cd_dong_1_thang as SELECT chidoan.ID, thangnam.NAMHOC_ID, namhoc.TEN_NH, chidoan.TEN_CD,(v_soluong_dv.soluong_dv*thangnam.SOTIEN_DOANPHI)*1/3 as sotien_cd_dong_1_thang 
FROM v_soluong_dv, chidoan, doankhoa, thangnam, namhoc
WHERE v_soluong_dv.ID = chidoan.ID
AND doankhoa.ID = chidoan.DOANKHOA_ID
AND namhoc.ID = thangnam.NAMHOC_ID
GROUP BY thangnam.SOTIEN_DOANPHI, namhoc.TEN_NH, chidoan.TEN_CD


SELECT chidoan.TEN_CD, namhoc.TEN_NH, (v_sotien_cd_dong_1_thang.sotien_cd_dong_1_thang)*12 as sotien_cd_phai_dong
FROM v_sotien_cd_dong_1_thang, chidoan, namhoc, thangnam
WHERE v_sotien_cd_dong_1_thang.NAMHOC_ID = namhoc.ID
AND v_sotien_cd_dong_1_thang.ID = chidoan.ID
AND namhoc.ID = thangnam.NAMHOC_ID 
GROUP BY chidoan.TEN_CD, namhoc.TEN_NH


DB::table('v_sotien_dong_1_thang')
->join('chidoan', 'chidoan.ID', 'v_sotien_dong_1_thang.ID')
->join('namhoc','namhoc.ID' , '=', 'v_sotien_dong_1_thang.NAMHOC_ID')
->join('thangnam','thangnam.NAMHOC_ID', 'namhoc.ID')
->select('chidoan.TEN_CD', 'v_sotien_dong

$tongtien = DB::table('chidoan')
->join('v_sotien_dong_1_thang')
->join('doanphi_thu_cd', 'chidoan.ID', '=', 'doanphi_thu_cd.CHIDOAN_ID')
->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_cd.THANGNAM_ID')
->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
->join('doanvien_thanhnien', 'chidoan.ID', '=', 'doanvien_thanhnien.CHIDOAN_ID')
->join('doankhoa', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
->join('khoa','khoa.ID','=','chidoan.KHOA_ID')

->select('chidoan.TEN_CD', 'namhoc.TEN_NH', 'khoa.TEN_KHOA', DB::raw('(COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)*1/3 as so_tien_da_dong'), DB::raw('(((COUNT(doanvien_thanhnien.ID)*thangnam.SOTIEN_DOANPHI)*12))/count(doanphi_thu_cd.THANGNAM_ID) as so_tien_phai_dong'))
->where('NAMHOC_ID', '=', $namhoc_dp->ID)
->groupBy('chidoan.TEN_CD', 'namhoc.TEN_NH','khoa.TEN_KHOA', 'thangnam.SOTIEN_DOANPHI')
->get();
->get();

CREATE VIEW v_sotien_cd_dong_1_nam as SELECT chidoan.ID, thangnam.NAMHOC_ID, chidoan.TEN_CD, namhoc.TEN_NH, (v_sotien_cd_dong_1_thang.sotien_cd_dong_1_thang)*12 as sotien_cd_phai_dong
FROM v_sotien_cd_dong_1_thang, chidoan, namhoc, thangnam
WHERE v_sotien_cd_dong_1_thang.NAMHOC_ID = namhoc.ID
AND v_sotien_cd_dong_1_thang.ID = chidoan.ID
AND namhoc.ID = thangnam.NAMHOC_ID 
GROUP BY chidoan.TEN_CD, namhoc.TEN_NH, chidoan.ID, thangnam.NAMHOC_ID;


CREATE view v_soluong_cd AS 
SELECT doankhoa.ID, doankhoa.TEN_DK, count(doanvien_thanhnien.ID) as soluong_cd
FROM doankhoa, chidoan
WHERE doankhoa.ID = chidoan.DOANKHOA_ID
GROUP BY doankhoa.ID, doankhoa.TEN_DK

CREATE view v_soluong_cd AS 
SELECT doankhoa.ID, doankhoa.TEN_DK, count(chidoan.ID) as soluong_cd
FROM doankhoa, chidoan
WHERE doankhoa.ID = chidoan.DOANKHOA_ID AND chidoan.DUYET_CD is null
GROUP BY doankhoa.ID, doankhoa.TEN_DK

CREATE view v_soluong_dv_ttdoan as select chidoan.ID, chidoan.TEN_CD, count(DOANVIEN_THANHNIEN_ID) as soluong_dv_ttdoan 
from doanvien_thanhnien, chidoan, qd_dv_ttdoan
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
and qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID = doanvien_thanhnien.ID
AND qd_dv_ttdoan.DUYET_TTD =1 
and doanvien_thanhnien.NGAYCHUYENSH_SV is null
AND doanvien_thanhnien.NGAYVAODOAN_SV is not null
GROUP BY chidoan.ID


select chidoan.ID, chidoan.TEN_CD, qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID
from doanvien_thanhnien, chidoan, qd_dv_ttdoan
WHERE chidoan.ID = doanvien_thanhnien.CHIDOAN_ID
and qd_dv_ttdoan.DOANVIEN_THANHNIEN_ID = doanvien_thanhnien.ID
AND qd_dv_ttdoan.DUYET_TTD = 1 
and doanvien_thanhnien.NGAYCHUYENSH_SV is null
AND doanvien_thanhnien.NGAYVAODOAN_SV is not null


SELECT chidoan.ID, chidoan.TEN_CD, khoa.TEN_KHOA, doankhoa.TEN_DK, count(doanvien_thanhnien.ID) as soluong_dv  
FROM doanvien_thanhnien, chidoan, khoa, doankhoa
WHERE doanvien_thanhnien.CHIDOAN_ID = chidoan.ID
and chidoan.KHOA_ID = khoa.ID
and  chidoan.DOANKHOA_ID = doankhoa.ID
and doanvien_thanhnien.NGAYVAODOAN_SV is not null
and doanvien_thanhnien.NGAYCHUYENSH_SV is null
and doanvien_thanhnien.NGAYTTDOAN_SV is null
GROUP BY chidoan.ID
ORDER BY doankhoa.ID, chidoan.ID ASC



$results = DB::table('doankhoa')
->join('doanphi_thu_dk', 'doankhoa.ID', '=', 'doanphi_thu_dk.DOANKHOA_ID')
->join('thangnam', 'thangnam.ID', '=', 'doanphi_thu_dk.THANGNAM_ID')
->join('namhoc', 'namhoc.ID', '=', 'thangnam.NAMHOC_ID')
->join('v_soluong_cd', 'v_soluong_cd.ID', '=', 'doankhoa.ID')
->join('chidoan', 'doankhoa.ID', '=', 'chidoan.DOANKHOA_ID')
->select('doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_da_dong'), 'v_soluong_cd.soluong_cd', DB::raw('((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong'),DB::raw('(((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12)-(COUNT(chidoan.ID)*thangnam.SOTIEN_DOANPHI)/3 as so_tien_chua_dong'), 'v_soluong_cd.soluong_cd' )
->where('NAMHOC_ID', '=', $nam_dp->ID)
->groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')
->orderBy('doankhoa.ID', 'asc')
->get();

select doankhoa.TEN_DK, namhoc.TEN_NH, ((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong, v_soluong_cd.soluong_cd
from doankhoa, doanphi_thu_dk, thangnam, namhoc, v_soluong_cd, chidoan
where doankhoa.ID = doanphi_thu_dk.DOANKHOA_ID
and thangnam.ID = doanphi_thu_dk.THANGNAM_ID
and namhoc.ID = thangnam.NAMHOC_ID
and v_soluong_cd.ID = doankhoa.ID
and chidoan.DOANKHOA_ID = doankhoa.ID
groupBy('namhoc.TEN_NH','doankhoa.TEN_DK', 'thangnam.SOTIEN_DOANPHI', 'v_soluong_cd.soluong_cd')



select doankhoa.TEN_DK, namhoc.TEN_NH, ((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong, v_soluong_cd.soluong_cd
from doankhoa, doanphi_thu_dk, thangnam, namhoc, v_soluong_cd, chidoan
where doankhoa.ID = doanphi_thu_dk.DOANKHOA_ID
and thangnam.ID = doanphi_thu_dk.THANGNAM_ID
and namhoc.ID = thangnam.NAMHOC_ID
and v_soluong_cd.ID = doankhoa.ID
and chidoan.DOANKHOA_ID = doankhoa.ID
GROUP BY namhoc.TEN_NH, doankhoa.TEN_DK, thangnam.SOTIEN_DOANPHI, v_soluong_cd.soluong_cd


select doankhoa.ID, doankhoa.TEN_DK, namhoc.TEN_NH, ((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)/3)*12 as so_tien_phai_dong, v_soluong_cd.soluong_cd
from doankhoa, doanphi_thu_dk, thangnam, namhoc, v_soluong_cd, chidoan
where doankhoa.ID = doanphi_thu_dk.DOANKHOA_ID
and thangnam.ID = doanphi_thu_dk.THANGNAM_ID
and namhoc.ID = thangnam.NAMHOC_ID
and v_soluong_cd.ID = doankhoa.ID
and chidoan.DOANKHOA_ID = doankhoa.ID
GROUP BY namhoc.TEN_NH, doankhoa.TEN_DK, thangnam.SOTIEN_DOANPHI, v_soluong_cd.soluong_cd, doankhoa.ID


CREATE view v_so_tien_phai_dong as select doankhoa.ID, doankhoa.TEN_DK, namhoc.TEN_NH, ((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)*2/3)*12 as so_tien_phai_dong, v_soluong_cd.soluong_cd
from doankhoa, doanphi_thu_dk, thangnam, namhoc, v_soluong_cd, chidoan
where doankhoa.ID = doanphi_thu_dk.DOANKHOA_ID
and thangnam.ID = doanphi_thu_dk.THANGNAM_ID
and namhoc.ID = thangnam.NAMHOC_ID
and v_soluong_cd.ID = doankhoa.ID
and chidoan.DOANKHOA_ID = doankhoa.ID
GROUP BY namhoc.TEN_NH, doankhoa.TEN_DK, thangnam.SOTIEN_DOANPHI, v_soluong_cd.soluong_cd, doankhoa.ID
ORDER BY doankhoa.ID ASC


select doankhoa.ID, doankhoa.TEN_DK, namhoc.TEN_NH, ((v_soluong_cd.soluong_cd*thangnam.SOTIEN_DOANPHI)*2/3)*12 as so_tien_phai_dong, v_soluong_cd.soluong_cd
from doankhoa, doanphi_thu_dk, thangnam, namhoc, v_soluong_cd, chidoan
where doankhoa.ID = doanphi_thu_dk.DOANKHOA_ID
and thangnam.ID = doanphi_thu_dk.THANGNAM_ID
and namhoc.ID = thangnam.NAMHOC_ID
and v_soluong_cd.ID = doankhoa.ID
and chidoan.DOANKHOA_ID = doankhoa.ID
GROUP BY namhoc.TEN_NH, doankhoa.TEN_DK, thangnam.SOTIEN_DOANPHI, v_soluong_cd.soluong_cd, doankhoa.ID
ORDER BY doankhoa.ID ASC


select doankhoa.ID, doankhoa.TEN_DK, namhoc.TEN_NH, sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa
from phieuchi_dk, doankhoa, pt_doankhoa, hocky, namhoc
where phieuchi_dk.DOANKHOA_ID = doankhoa.ID
and phieuchi_dk.PT_DOANKHOA_ID = pt_doankhoa.ID
and pt_doankhoa.HOCKY_ID = hocky.ID
and namhoc.ID = hocky.NAMHOC_ID
groupBy doankhoa.TEN_DK, namhoc.TEN_NH, doankhoa.ID
orderBy doankhoa.ID asc

select doankhoa.ID, doankhoa.TEN_DK, namhoc.TEN_NH, sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa
from phieuchi_dk, doankhoa, pt_doankhoa, hocky, namhoc
where phieuchi_dk.DOANKHOA_ID = doankhoa.ID
and phieuchi_dk.PT_DOANKHOA_ID = pt_doankhoa.ID
and pt_doankhoa.HOCKY_ID = hocky.ID
and namhoc.ID = hocky.NAMHOC_ID
group By doankhoa.TEN_DK, namhoc.TEN_NH, doankhoa.ID
order By doankhoa.ID ASC


select doankhoa.ID, doankhoa.TEN_DK, namhoc.TEN_NH, v_so_tien_phai_dong.so_tien_phai_dong-sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa
from phieuchi_dk, doankhoa, pt_doankhoa, hocky, namhoc, v_so_tien_phai_dong
where phieuchi_dk.DOANKHOA_ID = doankhoa.ID
and phieuchi_dk.PT_DOANKHOA_ID = pt_doankhoa.ID
and pt_doankhoa.HOCKY_ID = hocky.ID
and namhoc.ID = hocky.NAMHOC_ID
and v_so_tien_phai_dong.ID = phieuchi_dk.DOANKHOA_ID
group By doankhoa.TEN_DK, namhoc.TEN_NH, doankhoa.ID
order By doankhoa.ID ASC

DB::table('phieuchi_dk')
->join('doankhoa','phieuchi_dk.DOANKHOA_ID', '=','doankhoa.ID')
->join('pt_doankhoa','phieuchi_dk.PT_DOANKHOA_ID','=','pt_doankhoa.ID')
->join('hocky','pt_doankhoa.HOCKY_ID', '=','hocky.ID')
->join('namhoc','hocky.NAMHOC_ID','=','namhoc.ID')
->select( 'namhoc.TEN_NH','doankhoa.TEN_DK', 'namhoc.TEN_NH', DB::raw('sum(phieuchi_dk.SOTIEN_CHI_DK) as tongchi_doankhoa'))
->where('hocky.NAMHOC_ID', '=', $nam_dp->ID)
->groupBy('doankhoa.TEN_DK', 'namhoc.TEN_NH')
->orderBy('doankhoa.ID', 'asc')
->get();


