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
    public class AnaliseController : ControllerBase
    {
        private readonly LimsContext _context;

        public AnaliseController(LimsContext context)
        {
            _context = context;
        }

        // GET: api/Analise
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Analise>>> GetAnalise()
        {
            return await _context.Analise
                .Include(a => a.Amostra)
                .Include(s => s.Solucao)
                .ToListAsync();
        }

        // GET: api/Analise/5
        [HttpGet("{id}")]
        public async Task<ActionResult<Analise>> GetAnalise(int id)
        {
            var analise = await _context.Analise.FindAsync(id);

            if (analise == null)
            {
                return NotFound();
            }

            return analise;
        }

        // PUT: api/Analise/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAnalise(int id, Analise analise)
        {
            if (id != analise.Id)
            {
                return BadRequest();
            }

            _context.Entry(analise).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AnaliseExists(id))
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

        // POST: api/Analise
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPost]
        public async Task<ActionResult<Analise>> PostAnalise(Analise analise)
        {
            _context.Analise.Add(analise);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetAnalise", new { id = analise.Id }, analise);
        }

        // DELETE: api/Analise/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Analise>> DeleteAnalise(int id)
        {
            var analise = await _context.Analise.FindAsync(id);
            if (analise == null)
            {
                return NotFound();
            }

            _context.Analise.Remove(analise);
            await _context.SaveChangesAsync();

            return analise;
        }

        private bool AnaliseExists(int id)
        {
            return _context.Analise.Any(e => e.Id == id);
        }
    }
}
