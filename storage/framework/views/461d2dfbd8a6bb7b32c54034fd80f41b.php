<?php $__env->startSection('content'); ?>
<style>
    .manage-data-page {
        min-height: calc(100vh - 3.5rem);
        margin: -1.5rem;
        padding: 32px;
        background: #f8fafc;
        color: #172033;
        font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .manage-data-shell {
        max-width: 1160px;
        margin: 0 auto;
    }

    .manage-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 26px;
    }

    .breadcrumb {
        margin: 0 0 8px;
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .breadcrumb span {
        color: #f97316;
    }

    .manage-title h1 {
        margin: 0 0 7px;
        color: #111827;
        font-size: 28px;
        line-height: 1.1;
        font-weight: 900;
        letter-spacing: -0.03em;
    }

    .manage-title p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
    }

    .add-data-btn {
        border: 0;
        border-radius: 10px;
        background: #f97316;
        color: #ffffff;
        padding: 13px 20px;
        box-shadow: 0 14px 26px rgba(249, 115, 22, 0.25);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        cursor: pointer;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 26px;
    }

    .stat-card {
        min-height: 126px;
        border: 1px solid #e5e7eb;
        border-radius: 13px;
        background: #ffffff;
        padding: 22px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .stat-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 900;
    }

    .stat-icon.orange { background: #fff7ed; color: #f97316; }
    .stat-icon.blue { background: #eff6ff; color: #2563eb; }
    .stat-icon.green { background: #ecfdf5; color: #059669; }
    .stat-icon.red { background: #fff1f2; color: #ef4444; }

    .stat-change {
        color: #059669;
        font-size: 11px;
        font-weight: 900;
    }

    .stat-change.danger {
        color: #ef4444;
        text-transform: uppercase;
    }

    .stat-label {
        margin: 0 0 8px;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .stat-value {
        margin: 0;
        color: #0f172a;
        font-size: 30px;
        font-weight: 900;
        line-height: 1;
    }

    .data-panel {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #ffffff;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.05);
    }

    .data-tabs {
        display: flex;
        align-items: center;
        gap: 0;
        border-bottom: 1px solid #e5e7eb;
        padding: 0 24px;
        overflow-x: auto;
    }

    .data-tab {
        position: relative;
        min-height: 62px;
        border: 0;
        background: transparent;
        color: #64748b;
        padding: 0 28px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        cursor: pointer;
    }

    .data-tab:first-child {
        padding-left: 0;
    }

    .data-tab.active {
        color: #f97316;
    }

    .data-tab.active::after {
        content: "";
        position: absolute;
        left: 0;
        right: 28px;
        bottom: -1px;
        height: 2px;
        background: #f97316;
        border-radius: 999px;
    }

    .filter-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 22px 24px;
        background: #ffffff;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-label {
        color: #94a3b8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .filter-select {
        min-width: 170px;
        border: 1px solid #dbe3ef;
        border-radius: 8px;
        background: #ffffff;
        color: #475569;
        padding: 10px 12px;
        font-size: 12px;
        font-weight: 700;
        outline: none;
    }

    .result-count {
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .table-wrap {
        overflow-x: auto;
    }

    .manage-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 930px;
    }

    .manage-table thead {
        background: #f1f5f9;
    }

    .manage-table th {
        padding: 17px 20px;
        color: #334155;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-align: left;
        text-transform: uppercase;
    }

    .manage-table td {
        padding: 18px 20px;
        border-top: 1px solid #edf2f7;
        color: #475569;
        font-size: 13px;
        vertical-align: middle;
    }

    .incident-type {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #0f172a;
        font-weight: 900;
        line-height: 1.15;
    }

    .incident-dot {
        width: 7px;
        height: 7px;
        border-radius: 999px;
        display: inline-flex;
        flex: 0 0 auto;
    }

    .incident-dot.red { background: #fda4af; }
    .incident-dot.orange { background: #f97316; }
    .incident-dot.green { background: #10b981; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .status-badge.critical { background: #fff1f2; color: #fb7185; }
    .status-badge.controlled { background: #fff7ed; color: #f97316; }
    .status-badge.done { background: #dcfce7; color: #16a34a; }
    .status-badge.alert { background: #fef2f2; color: #ef4444; }

    .timestamp {
        color: #64748b;
        font-size: 11px;
        line-height: 1.3;
    }

    .detail-btn {
        border: 0;
        border-radius: 4px;
        background: #0f172a;
        color: #ffffff;
        padding: 10px 17px;
        font-size: 10px;
        font-weight: 900;
        line-height: 1.05;
        cursor: pointer;
    }

    .analytics-row {
        display: flex;
        justify-content: flex-end;
        padding: 26px 0 0;
    }

    .analytics-card {
        width: 315px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #ffffff;
        padding: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.05);
    }

    .analytics-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .analytics-head h3 {
        margin: 0;
        color: #f97316;
        font-size: 14px;
        font-weight: 900;
    }

    .analytics-head span {
        color: #f97316;
        font-weight: 900;
    }

    .analytics-card p {
        margin: 0 0 18px;
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.55;
        font-weight: 600;
    }

    .progress-track {
        height: 6px;
        border-radius: 999px;
        background: #e5e7eb;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .progress-fill {
        width: 75%;
        height: 100%;
        background: #f97316;
        border-radius: 999px;
    }

    .progress-meta {
        display: flex;
        justify-content: space-between;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
    }

    @media (max-width: 1120px) {
        .stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .manage-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 760px) {
        .manage-data-page {
            margin: -1.5rem;
            padding: 22px 16px;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }

        .filter-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .filter-select {
            width: 100%;
        }

        .analytics-card {
            width: 100%;
        }
    }
</style>

<section class="manage-data-page">
    <div class="manage-data-shell">
        <div class="manage-header">
            <div class="manage-title">
                <p class="breadcrumb">Management / <span>Kelola Data Informasi</span></p>
                <h1>Kelola Data Informasi</h1>
                <p>Overview of active disasters and critical infrastructure deployment.</p>
            </div>

            <button class="add-data-btn" type="button">
                <i class="fa-solid fa-circle-plus"></i>
                Tambah Data
            </button>
        </div>

        <div class="stat-grid" aria-label="Ringkasan data informasi">
            <article class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon orange"><i class="fa-solid fa-triangle-exclamation"></i></span>
                    <span class="stat-change">+12%</span>
                </div>
                <p class="stat-label">Active Incidents</p>
                <p class="stat-value">24</p>
            </article>

            <article class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon blue"><i class="fa-solid fa-shelter"></i></span>
                    <span class="stat-change">+12%</span>
                </div>
                <p class="stat-label">Active Shelters</p>
                <p class="stat-value">118</p>
            </article>

            <article class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon green"><i class="fa-solid fa-kit-medical"></i></span>
                    <span class="stat-change">Operational</span>
                </div>
                <p class="stat-label">Medical Units</p>
                <p class="stat-value">42</p>
            </article>

            <article class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon red"><i class="fa-solid fa-exclamation"></i></span>
                    <span class="stat-change danger">Urgent</span>
                </div>
                <p class="stat-label">Action Items</p>
                <p class="stat-value">07</p>
            </article>
        </div>

        <section class="data-panel">
            <div class="data-tabs" role="tablist" aria-label="Kategori kelola data">
                <button class="data-tab active" type="button">Laporan Bencana</button>
                <button class="data-tab" type="button">Jalur Evakuasi</button>
                <button class="data-tab" type="button">Shelter dan Posko</button>
                <button class="data-tab" type="button">Fasilitas Kesehatan</button>
                <button class="data-tab" type="button">Catatan Penanggulangan</button>
            </div>

            <div class="filter-row">
                <div class="filter-group">
                    <span class="filter-label">Filter by:</span>
                    <select class="filter-select" aria-label="Filter status">
                        <option>Status (Semua)</option>
                        <option>Kritis</option>
                        <option>Terkendali</option>
                        <option>Selesai</option>
                    </select>
                    <select class="filter-select" aria-label="Filter tipe bencana">
                        <option>Tipe Bencana (Semua)</option>
                        <option>Banjir</option>
                        <option>Tanah Longsor</option>
                        <option>Kebakaran</option>
                        <option>Gempa Bumi</option>
                    </select>
                    <select class="filter-select" aria-label="Filter wilayah">
                        <option>Wilayah (Semua)</option>
                        <option>Jakarta Timur</option>
                        <option>Jakarta Selatan</option>
                        <option>Kebayoran Baru</option>
                        <option>Sukabumi</option>
                    </select>
                </div>

                <span class="result-count">Showing 24 results of 102</span>
            </div>

            <div class="table-wrap">
                <table class="manage-table">
                    <thead>
                        <tr>
                            <th>Tipe Bencana</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Pelapor</th>
                            <th>Update<br>Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="incident-type"><span class="incident-dot red"></span><span>Banjir<br>Bandang</span></div>
                            </td>
                            <td>Jl. Melati No. 42,<br>Cawang, Jakarta Timur</td>
                            <td><span class="status-badge critical">Kritis</span></td>
                            <td>Bpk.<br>Supriyadi</td>
                            <td><div class="timestamp">2023-10-24<br>14:22</div></td>
                            <td><button class="detail-btn" type="button">VIEW<br>DETAIL</button></td>
                        </tr>

                        <tr>
                            <td>
                                <div class="incident-type"><span class="incident-dot orange"></span><span>Tanah<br>Longsor</span></div>
                            </td>
                            <td>Bukit Hijau,<br>Jagakarsa, Jakarta Selatan</td>
                            <td><span class="status-badge controlled">Terkendali</span></td>
                            <td>Siti Aminah</td>
                            <td><div class="timestamp">2023-10-24<br>13:05</div></td>
                            <td><button class="detail-btn" type="button">VIEW<br>DETAIL</button></td>
                        </tr>

                        <tr>
                            <td>
                                <div class="incident-type"><span class="incident-dot green"></span><span>Kebakaran<br>Ruko</span></div>
                            </td>
                            <td>Blok M Square,<br>Kebayoran Baru</td>
                            <td><span class="status-badge done">Selesai</span></td>
                            <td>Petugas<br>Keamanan</td>
                            <td><div class="timestamp">2023-10-24<br>10:45</div></td>
                            <td><button class="detail-btn" type="button">VIEW<br>DETAIL</button></td>
                        </tr>

                        <tr>
                            <td>
                                <div class="incident-type"><span class="incident-dot red"></span><span>Gempa Bumi<br>(M 5.4)</span></div>
                            </td>
                            <td>Pusat Kota, Sukabumi<br>(Impacted Jakarta)</td>
                            <td><span class="status-badge alert">Siaga</span></td>
                            <td>BMKG Center</td>
                            <td><div class="timestamp">2023-10-24<br>14:55</div></td>
                            <td><button class="detail-btn" type="button">VIEW<br>DETAIL</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <div class="analytics-row">
            <aside class="analytics-card" aria-label="Data analytics">
                <div class="analytics-head">
                    <h3>Data Analytics</h3>
                    <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                </div>
                <p>Report frequency has increased by 14% in the last 24 hours. Recommended to increase personnel at Cluster C.</p>
                <div class="progress-track"><div class="progress-fill"></div></div>
                <div class="progress-meta">
                    <span>Response Capacity</span>
                    <strong>75%</strong>
                </div>
            </aside>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\golde\Downloads\disaster_alert_app\resources\views/pages/officer/manage-data.blade.php ENDPATH**/ ?>