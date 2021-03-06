var express = require('express');
var router = express.Router();

var sql = require('../database/sql')

const sectionIcons = [
  'π', 'πΏ', 'π', 'π£', 'π₯©', 'β', 'π°'
]

const statusKorMap = {
  OPN: 'μμμ€', 
  CLS: 'νμ',
  VCT: 'ν΄κ°μ€',
  RMD: 'λ¦¬λͺ¨λΈλ§'
}

router.get('/', async function(req, res, next) {

  const sections = await sql.getSections()
  sections.map((item) => {
    item.icon = sectionIcons[item.section_id - 1]
  })

  res.render('sections', { 
    title: 'LIST',
    sections
  });
});

/* μλΉ λ¨μν λ³΄κΈ° */
router.get('/biz-simple', async function(req, res, next) {
  const businesses = await sql.getBusinessesJoined(req.query) // ?section={{ section_id }} μ μ λ³΄κ° λ΄κ²¨μμ
  businesses.map((item) => {
    item.status_kor = statusKorMap[item.status]
    return item
  })

  res.render('biz-simple', { 
    title: 'λ¨μ μλΉ λͺ©λ‘',
    businesses
  });
});

/* μ ν λΆλ₯λ³ λ³΄κΈ° */
router.get('/biz-adv', async function(req, res, next) {
  const businesses = await sql.getBusinessesJoined(req.query)
  businesses.map((item) => {
    item.status_kor = statusKorMap[item.status]
    return item
  })

  res.render('biz-adv', { 
    title: 'κ³ κΈ μλΉ λͺ©λ‘',
    q: req.query,
    businesses
  });
});

router.get('/business/:id', async function(req, res, next) {
  const biz = await sql.getSingleBusinessJoined(req.params.id)
  biz.status_kor = statusKorMap[biz.status]
  biz.icon = sectionIcons[biz.section_id - 1]

  const menus = await sql.getMenusOfBusiness(req.params.id)
  const ratings = await sql.getRatingsOfBusiness(req.params.id)

  res.render('detail', { 
    biz,
    menus,
    ratings
  });

  /* λ©λ΄ μ’μμ */
  router.put('/menus/:id', async function(req, res, next) {
    // λ³κ²½μ΄λ μλ°μ΄νΈ : put
    const result = await sql.updateMenuLikes(req.params.id, req.body.like)
    res.send(result)
  });

  /* λ³μ , μ½λ©νΈ */
  router.post('/ratings', async function(req, res, next) {
    const result = await sql.addRating(
      req.body.business_id,
      req.body.stars,
      req.body.comment
    )
    res.send(result)
  });
  
  router.delete('/ratings/:id', async function(req, res, next) {
    const result = await sql.removeRating(req.params.id)
    res.send(result)
  });
});

module.exports = router;
