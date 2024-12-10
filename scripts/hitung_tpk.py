import pandas as pd
from datetime import datetime, timedelta

# Load data dari CSV
data = pd.read_csv('storage/app/public/data_saw.csv')

# Bobot kriteria
bobot = {
    'jumlah_terjual': 0.4,  # Benefit
    'harga_jual': 0.3,      # Cost
    'profit': 0.3           # Benefit
}

# Normalisasi
data['norm_terjual'] = data['jumlah_terjual'] / data['jumlah_terjual'].max()
data['norm_harga'] = data['harga_jual'].min() / data['harga_jual']
data['norm_profit'] = data['profit'] / data['profit'].max()

# Hitung TPK
data['tpk'] = (
    data['norm_terjual'] * bobot['jumlah_terjual'] +
    data['norm_harga'] * bobot['harga_jual'] +
    data['norm_profit'] * bobot['profit']
)

# Urutkan berdasarkan TPK dan pilih 5 produk teratas
top_5_data = data.sort_values(by='tpk', ascending=False).head(5)

# Simpan hasil ke CSV
top_5_data.to_csv('storage/app/public/hasil_tpk_top5.csv', index=False)
