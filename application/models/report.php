<?php
class report extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function tabel_statistik1()
	{
		$sql = "SELECT COUNT( DISTINCT PRS.ID_PERUSAHAAN ) AS PENGEMBANG, SUM( ID_IJIN ) AS IJIN_LOKASI, SUM( LUAS ) AS LUAS_IJIN_LOKASI, SUM( RENCANA_TAPAK ) AS RENCANA_TAPAK, SUM( PEMBEBASAN ) AS PEMBEBASAN, SUM( TERBANGUN ) AS TERBANGUN, SUM( BELUM_TERBANGUN ) AS BELUM_TERBANGUN
				FROM PEMBANGUNAN AS PEM
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN IJIN AS IJIN ON IJIN.ID_IJIN = PRM.ID_PERUMAHAN
				WHERE PEM.TAHUN = '2014'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	
	public function tabel_statistik2_rencana()
	{
		$sql = "SELECT SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO
				FROM PEMBANGUNAN
				WHERE PEMBANGUNAN.TAHUN = '2014'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_statistik2_realisasi()
	{
		$sql = "SELECT SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM PEMBANGUNAN
				WHERE PEMBANGUNAN.TAHUN = '2014'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_report_kecamatan_value()//BUTUH ID
	{
		$sql = "SELECT NAMA_PERUSAHAAN, PIMPINAN, ALAMAT, TELP, FAX,NAMA_LOKASI AS LOKASI, RENC_RSS,RENC_RS,RENC_RM,RENC_MW,RENC_RUKO,REAL_RSS,REAL_RS,REAL_RM,REAL_MW,REAL_RUKO,PEM.CATATAN AS CATATAN
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '2014' AND PEM.TRIWULAN = '1' AND KEC.ID_KECAMATAN = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function jumlah_kecamatan()
	{
		$sql = "SELECT COUNT( ID_KECAMATAN ) AS JUMLAH
				FROM KECAMATAN";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_pembangunan_kecamatan_all()
	{
		$sql = "SELECT NAMA_KECAMATAN, COUNT( NAMA_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO, PEM.CATATAN AS CATATAN
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				GROUP BY KEC.ID_KECAMATAN";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_pembangunan_kecamatan_all_statistic()
	{
		$sql = "SELECT SUM(JML_LOKASI) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM
				(
				SELECT COUNT( NAMA_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				GROUP BY KEC.ID_KECAMATAN) AS TBL";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}


	public function tabel_lahan_kecamatan_all($id_kecamatan)
	{
		$sql = "SELECT NAMA_KECAMATAN,COUNT(NAMA_LOKASI) AS JML_IJIN_LOKASI, SUM(LUAS) AS LUAS, SUM(RENCANA_TAPAK) AS RENCANA_TAPAK, SUM(PEMBEBASAN) AS PEMBEBASAN, SUM(TERBANGUN) AS TERBANGUN, SUM(BELUM_TERBANGUN) AS BELUM_TERBANGUN, SUM(FS_DIALOKASIKAN) AS DIALOKASIKAN,SUM(FS_PEMBEBASAN) AS PEMBEBASAN,SUM(FS_SUDAH_DIMATANGKAN) AS DIMATANGKAN 
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan." AND PEM.TAHUN = '2014' AND PEM.TRIWULAN = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_lahan_kecamatan_all_statistic()
	{
		$sql = "SELECT SUM(JML_PENGEMBANG) AS JML_PENGEMBANG, SUM(JML_IJIN_LOKASI) AS JML_IJIN_LOKASI, SUM(LUAS) AS LUAS, SUM(RENCANA_TAPAK) AS RENCANA_TAPAK, SUM(PEMBEBASAN) AS PEMBEBASAN, SUM(TERBANGUN) AS TERBANGUN, SUM(BELUM_TERBANGUN) AS BELUM_TERBANGUN
				FROM(
				SELECT COUNT(DISTINCT(PRS.NAMA_PERUSAHAAN))AS JML_PENGEMBANG,COUNT(NAMA_LOKASI) AS JML_IJIN_LOKASI, SUM(LUAS) AS LUAS, SUM(RENCANA_TAPAK) AS RENCANA_TAPAK, SUM(PEMBEBASAN) AS PEMBEBASAN, SUM(TERBANGUN) AS TERBANGUN, SUM(BELUM_TERBANGUN) AS BELUM_TERBANGUN, SUM(FS_DIALOKASIKAN) AS DIALOKASIKAN,SUM(FS_PEMBEBASAN) AS FS_PEMBEBASAN,SUM(FS_SUDAH_DIMATANGKAN) AS DIMATANGKAN 
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				WHERE  PEM.TAHUN = '2014' AND PEM.TRIWULAN = '1'
				GROUP BY KEC.ID_KECAMATAN) AS TBLI";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}


	public function aktif_dalam_pebangunan($id_kecamatan)
	{
		$sql = "SELECT COUNT( AKTIF_DLM_PEMBANGUNAN ) AS AKTIF_DLM_PEMBANGUNAN
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				AND AKTIF_DLM_PEMBANGUNAN = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function aktif_berhenti($id_kecamatan)
	{
		$sql = "SELECT COUNT( AKTIF_BERHENTI ) AS AKTIF_BERHENTI
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				AND AKTIF_BERHENTI = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function aktif_sdh_selesai($id_kecamatan)
	{
		$sql = "SELECT COUNT( AKTIF_SDH_SELESAI ) AS AKTIF_SDH_SELESAI
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				AND AKTIF_SDH_SELESAI = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tidak_aktif($id_kecamatan)
	{
		$sql = "SELECT COUNT( TIDAK_AKTIF ) AS TIDAK_AKTIF
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				AND TIDAK_AKTIF = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function lahan_perkecamatan_value()//BUTUH ID
	{
		$sql = "SELECT NAMA_PERUSAHAAN, PIMPINAN, ALAMAT, TELP, FAX, NAMA_LOKASI,LOKASI_TGL, LUAS, RENCANA_TAPAK, PEMBEBASAN, TERBANGUN, BELUM_TERBANGUN, FS_DIALOKASIKAN AS DIALOKASIKAN, FS_PEMBEBASAN AS PEMBEBASAN, FS_SUDAH_DIMATANGKAN AS SUDAH_DIMATANGKAN, IJIN.CATATAN AS CATATAN, AKTIF_DLM_PEMBANGUNAN, AKTIF_BERHENTI, AKTIF_SDH_SELESAI, TIDAK_AKTIF
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				WHERE KEC.ID_KECAMATAN = '1'
				AND PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_pem_kec()
	{
		$sql = "SELECT SUM( JML_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM (

				SELECT COUNT( NAMA_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				GROUP BY KEC.ID_KECAMATAN
				) AS TBL";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function tabel_statistik_lah_perkec()//BUTUH ID
	{
		$sql = "SELECT SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO
				FROM(
				SELECT SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( 		RENC_RUKO ) AS RENC_RUKO
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'
				GROUP BY KEC.ID_KECAMATAN) AS TBL";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

		

	/**public function jumlah_pembangunan()
	{
		$sql = "SELECT COUNT(*) AS jumlah_pembangunan FROM pembangunan";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}**/
}
?>
