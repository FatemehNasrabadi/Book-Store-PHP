 sql::SELECT COUNT(*) AS today_users FROM users WHERE DATE(created_at)=CURDATE();
 