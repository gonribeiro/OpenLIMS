using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using LIMS.Models;

namespace LIMS.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class CalibracaoController : ControllerBase
    {
        private readonly LimsContext _context;

        public CalibracaoController(LimsContext context)
        {
            _context = context;
        }

        // GET: api/Calibracao/(EquipamentoId)5
        // Retorna todas as calibrações a partir do Id de um equipamento
        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<Calibracao>>> GetCalibracoes(int id)
        {
            return await _context.Calibracoes
                            .Where(s => s.EquipamentoId == id)
                            .ToListAsync();
        }

        // PUT: api/Calibracao/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutCalibracao(int id, Calibracao calibracao)
        {
            if (id != calibracao.Id)
            {
                return BadRequest();
            }

            _context.Entry(calibracao).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!CalibracaoExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Calibracao
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPost]
        public async Task<ActionResult<Calibracao>> PostCalibracao(Calibracao calibracao)
        {
            _context.Calibracoes.Add(calibracao);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetCalibracao", new { id = calibracao.Id }, calibracao);
        }

        // DELETE: api/Calibracao/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Calibracao>> DeleteCalibracao(int id)
        {
            var calibracao = await _context.Calibracoes.FindAsync(id);
            if (calibracao == null)
            {
                return NotFound();
            }

            _context.Calibracoes.Remove(calibracao);
            await _context.SaveChangesAsync();

            return calibracao;
        }

        private bool CalibracaoExists(int id)
        {
            return _context.Calibracoes.Any(e => e.Id == id);
        }
    }
}
