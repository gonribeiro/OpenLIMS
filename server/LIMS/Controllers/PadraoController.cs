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
    public class PadraoController : ControllerBase
    {
        private readonly LimsContext _context;

        public PadraoController(LimsContext context)
        {
            _context = context;
        }

        // GET: api/Padrao
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Padrao>>> GetPadroes()
        {
            return await _context.Padroes.Include(u => u.Unidade).ToListAsync();
        }

        // GET: api/Padrao/5
        [HttpGet("{id}")]
        public async Task<ActionResult<Padrao>> GetPadrao(int id)
        {
            var padrao = await _context.Padroes.FindAsync(id);

            if (padrao == null)
            {
                return NotFound();
            }

            return padrao;
        }

        // PUT: api/Padrao/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutPadrao(int id, Padrao padrao)
        {
            if (id != padrao.Id)
            {
                return BadRequest();
            }

            _context.Entry(padrao).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!PadraoExists(id))
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

        // POST: api/Padrao
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPost]
        public async Task<ActionResult<Padrao>> PostPadrao(Padrao padrao)
        {
            _context.Padroes.Add(padrao);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetPadrao", new { id = padrao.Id }, padrao);
        }

        // DELETE: api/Padrao/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Padrao>> DeletePadrao(int id)
        {
            var padrao = await _context.Padroes.FindAsync(id);
            if (padrao == null)
            {
                return NotFound();
            }

            _context.Padroes.Remove(padrao);
            await _context.SaveChangesAsync();

            return padrao;
        }

        private bool PadraoExists(int id)
        {
            return _context.Padroes.Any(e => e.Id == id);
        }
    }
}
