const mysql = require('mysql2');

const pool = mysql.createPool(
  process.env.JAWSDB_URL ?? {
    host: 'localhost',
    user: 'root',
    database: 'local',
    password: 'root',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0,
    port: 10011
  }
);
const promisePool = pool.promise();

const sql = {

  /* 전체보기 */
  getSections : async () => {
    const [rows] = await promisePool.query(`
      SELECT * FROM sections
    `)
    return rows
  },

  /* 선택 단순히 보기 */
  getBusinessesJoined : async (query) => {
    const sqlQuery = `
      SELECT * FROM sections S
      LEFT JOIN businesses B
        ON S.section_id = B.fk_section_id
      WHERE TRUE
        ${query.section
          ? ('AND section_id = ' + query.section) : ''}
        ${query.floor
          ? ('AND floor = ' + query.floor) : ''}
        ${query.status
          ? ("AND status = '" + query.status + "'") : ''}
      ORDER BY
         ${query.order 
          ? query.order : 'business_id'}
    `
    console.log(sqlQuery)

    const [rows] = await promisePool.query(sqlQuery)
    return rows
  },

  /* 식당 자세히 보기 */
  getSingleBusinessJoined : async (business_id) => {
    const [rows] = await promisePool.query(`
      SELECT * FROM sections S
      LEFT JOIN businesses B
        ON S.section_id = B.fk_section_id
      WHERE business_id = ${business_id}
    `)
    return rows[0]
  },

  getMenusOfBusiness : async (business_id) => {
    const [rows] = await promisePool.query(`
      SELECT * FROM menus
      WHERE fk_business_id = ${business_id}
    `)
    return rows
  },

  getRatingsOfBusiness : async (business_id) => {
    const [rows] = await promisePool.query(`
      SELECT rating_id, stars, comment,
      DATE_FORMAT(
        created, '%y년 %m월 %d일 %p %h시 %i분 %s초'
      ) AS created_fmt
      FROM ratings
      WHERE fk_business_id = ${business_id}
    `)
    return rows
  },
  
  /* 메뉴 좋아요 */
  updateMenuLikes : async (id, like) => {
    return await promisePool.query(`
      UPDATE menus
      SET likes = likes + ${like}
      WHERE menu_id = ${id}
    `)
  },

  /* 별점, 코멘트 */
  addRating : async (business_id, stars, comment) => {
    return await promisePool.query(`
      INSERT INTO ratings
      (fk_business_id, stars, comment)
      VALUES
      (${business_id}, '${stars}', '${comment}')
    `)
  },

  removeRating : async (rating_id) => {
    return await promisePool.query(`
      DELETE FROM ratings
      WHERE rating_id = ${rating_id}
    `)
  }

}

module.exports = sql