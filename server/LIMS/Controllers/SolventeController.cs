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
    public class SolventeController : ControllerBase
    {
        private readonly LimsContext _context;

        public SolventeController(LimsContext context)
        {
            _context = context;
        }

        // GET: api/Solvente
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Solvente>>> GetSolventes()
        {
            return await _context.Solventes.ToListAsync();
        }

        // GET: api/Solvente/5
        [HttpGet("{id}")]
        public async Task<ActionResult<Solvente>> GetSolvente(int id)
        {
            var solvente = await _context.Solventes.FindAsync(id);

            if (solvente == null)
            {
                return NotFound();
            }

            return solvente;
        }

        // PUT: api/Solvente/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutSolvente(int id, Solvente solvente)
        {
            if (id != solvente.Id)
            {
                return BadRequest();
            }

            _context.Entry(solvente).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!SolventeExists(id))
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

        // POST: api/Solvente
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPost]
        public async Task<ActionResult<Solvente>> PostSolvente(Solvente solvente)
        {
            _context.Solventes.Add(solvente);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetSolvente", new { id = solvente.Id }, solvente);
        }

        // DELETE: api/Solvente/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Solvente>> DeleteSolvente(int id)
        {
            var solvente = await _context.Solventes.FindAsync(id);
            if (solvente == null)
            {
                return NotFound();
            }

            _context.Solventes.Remove(solvente);
            await _context.SaveChangesAsync();

            return solvente;
        }

        private bool SolventeExists(int id)
        {
            return _context.Solventes.Any(e => e.Id == id);
        }
    }
}
