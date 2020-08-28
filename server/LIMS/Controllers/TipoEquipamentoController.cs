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
    public class TipoEquipamentoController : ControllerBase
    {
        private readonly LimsContext _context;

        public TipoEquipamentoController(LimsContext context)
        {
            _context = context;
        }

        // GET: api/TipoEquipamento
        [HttpGet]
        public async Task<ActionResult<IEnumerable<TipoEquipamento>>> GetTiposEquipamento()
        {
            return await _context.TiposEquipamento.ToListAsync();
        }

        // GET: api/TipoEquipamento/5
        [HttpGet("{id}")]
        public async Task<ActionResult<TipoEquipamento>> GetTipoEquipamento(int id)
        {
            var tipoEquipamento = await _context.TiposEquipamento.FindAsync(id);

            if (tipoEquipamento == null)
            {
                return NotFound();
            }

            return tipoEquipamento;
        }

        // PUT: api/TipoEquipamento/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutTipoEquipamento(int id, TipoEquipamento tipoEquipamento)
        {
            if (id != tipoEquipamento.Id)
            {
                return BadRequest();
            }

            _context.Entry(tipoEquipamento).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TipoEquipamentoExists(id))
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

        // POST: api/TipoEquipamento
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPost]
        public async Task<ActionResult<TipoEquipamento>> PostTipoEquipamento(TipoEquipamento tipoEquipamento)
        {
            _context.TiposEquipamento.Add(tipoEquipamento);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetTipoEquipamento", new { id = tipoEquipamento.Id }, tipoEquipamento);
        }

        // DELETE: api/TipoEquipamento/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<TipoEquipamento>> DeleteTipoEquipamento(int id)
        {
            var tipoEquipamento = await _context.TiposEquipamento.FindAsync(id);
            if (tipoEquipamento == null)
            {
                return NotFound();
            }

            _context.TiposEquipamento.Remove(tipoEquipamento);
            await _context.SaveChangesAsync();

            return tipoEquipamento;
        }

        private bool TipoEquipamentoExists(int id)
        {
            return _context.TiposEquipamento.Any(e => e.Id == id);
        }
    }
}
